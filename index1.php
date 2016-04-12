<?php include('head_index.php'); ?>
<!-- Note: Here is the iframe which displays the image map. Use the admin to process the image map -->
<div style="padding:0px 6px;">
	<!--<iframe style="  border-right: 1px solid #D4E275; border-bottom: 1px solid #D4E275; " width="1000" height="1000" frameborder=0 marginwidth=0 marginheight=0 VSPACE=0 HSPACE=0 SCROLLING=no allowtransparency="true" src="display_map.php?BID=1"></iframe>-->
	<!-- New grid 09072015 -->
	<?php $sql = mysql_query("SELECT DISTINCT blocks.order_id, blocks.user_id,blocks.url,blocks.block_id,blocks.alt_text, blocks.ad_id, COUNT(*) AS Total, ads.3, ads.thumb, MIN(x) AS x1,MAX(x) AS x2,MIN(y) AS y1,MAX(y) AS y2
                     FROM blocks, ads
                    WHERE (published = 'Y')
					  AND (status = 'sold' ) 
                      AND (blocks.banner_id = '1')
                      AND (image_data > '')
                      AND (image_data = image_data) AND ads.ad_id = blocks.ad_id 
                 GROUP BY order_id");
		$arr_ads = array();
		while($row = mysql_fetch_assoc($sql)){			
			$arr_ads[] = $row;
		}
		/*echo "<pre>";
		print_r($arr_ads);
		echo "</pre>";		*/
		
		$content_sticky = "";
	?>
	<div id="main_grid" style="margin-left: auto;margin-right: auto;">	
		<?php for($doc = 0; $doc < 100 ; $doc++){ ?>
			<?php for($ngang = 0; $ngang < 100 ; $ngang++){ ?>
				<?php $flag = 0; foreach($arr_ads as $ad ){ ?>					
					<?php 
					if($ngang*10 == $ad['x1'] && $doc*10 == $ad['y1'])
					{ ?>
						<?php $content_sticky .= '<div id="sticky'.$ad['x1'].$ad['y1'].'" class="atip">'.$ad['alt_text'].'<br><img src="http://milliondollardesiclub.com/upload_files/images/'.$ad['3'].'" /></div>'; ?>			
						<span class="grid">
							<a target="_blank" href="http://milliondollardesiclub.com/click.php?block_id=<?php echo $ad['block_id'] ?>&BID=1" data-tooltip="sticky<?php echo $ad['x1'].$ad['y1']; ?>">
								<img src="http://milliondollardesiclub.com/upload_files/images/<?php echo $ad['thumb']; ?>"  class="on_index" />
							</a>
						</span>
					<?php $flag = 1; 
					} ?>									
				<?php } ?>	
				
				<?php if($flag == 0){ ?>
				<span class="grid"></span>
				<?php } ?>
				
			<?php } ?>
		<?php } ?>
		<?php for($i = 0; $i < 50; $i++){ ?>
		<span class="grid"></span>
		<?php } ?>
		<div style="clear:both;"></div>
	</div>	
	<div id="mystickytooltip" class="stickytooltip">
		<div style="padding:5px">
			<?php echo $content_sticky; ?>				
		</div>		
	</div>
	<!-- /.New grid 09072015 -->
</div>
	
<div style="margin-top:100px;font-size:xx-small;color:#D8DB43; text-align:center;font-family:Verdana, Geneva, Arial, Helvetica, sans-serif;text-transform:capitalize;">
<span><a href='#'><img class="social" src="../images/ico-face.png" /></a><a  href='#'><img class="social" src="../images/ico-gplus.png" /></a><a  href='#'><img class="social" src="../images/ico-likein.png" /></a><a  href='#'><img class="social" src="../images/ico-twit.png" /></a></span>

<br>
Powered By <a target="_blank" style="font-size:7pt;color:#D8DB43;" href="http://milliondollardesiclub.com/">Million Dollar Desi Club</a> (c) 2015<br><br>
<img src="http://counter8.bestfreecounterstat.com/private/freecounterstat.php?c=f81f73aa1976b6fe797612ffd38d6935" border="0" title="hit counter" alt="hit counter"></div>

</body>
<script>		
	var height_grid = $('#main_grid').height();				
	$('#main_grid').attr('style', 'height:' + (height_grid - 22)+ 'px;margin-left:auto; margin-right:auto;');
	
	$(window).load(function(){
		create_height();
	});
	function create_height(){
		window.addEventListener("orientationchange", function() {		  
		  $('#main_grid').attr('style', 'height:auto');
		  var height_grid = $('#main_grid').height();				
		  $('#main_grid').attr('style', 'height:' + (height_grid - 22)+ 'px; margin-left:auto; margin-right:auto;');
		}, false);
	}	
</script>