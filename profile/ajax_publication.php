<?php 
	include '../config.php';
	
	$user_id = $_GET['user_id'];
	$check = mysql_query("select id from candidate_cv  where user_id = ".$user_id);
	
	if(!empty($_GET['id'])){
		mysql_query("delete from publications where id = ".$_GET['id']);
	}
	
	if(mysql_num_rows($check) == 0){
		exit;
	}
	
	$candidate_cv = mysql_fetch_assoc($check);
	
	$publicationList = mysql_query("select * from publications where cv_id = ".$candidate_cv['id']." order by id");
	
	$arrPublication = array();
	while($publication = mysql_fetch_assoc($publicationList)){
		$arrPublication[] = $publication;
	}
	
	
	$list = "";
	for($i = 2; $i < 20; $i++){		
		
		$anhien = '';
		if(isset($arrPublication[($i-1)])){ 
			$anhien = 'style="display:block !important;"'; 
		}				
		
		$themmoi = "";
		if(isset($arrPublication[$i])){ 
			$themmoi = 'display:none !important;'; 
		}
		
		$list .= '<div id="publication_'.$i.'" '.$anhien.'>				
			<hr style="width:100%;border-color:#D8DB43;">
			<input type="hidden" value="'.$arrPublication[($i-1)]['id'].'" id="id_publication'.$i.'"
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Title</h5>
			<input type="text" name="publication[title'.$i.']" placeholder="Title" value="'.$arrPublication[($i-1)]['title'].'" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Publications/Publisher</h5>
			<input type="text" name="publication[publication_publisher'.$i.']" placeholder="Publications/Publisher" value="'.$arrPublication[($i-1)]['publication_publisher'].'" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Publications Dates</h5>
			<input type="text" id="date_publication'.$i.'" name="publication_date[date'.$i.']" value="'.$arrPublication[($i-1)]['publication_date'].'" placeholder="Publications Dates" style="float:left;width:30%;" />
			<script>			 
				$( "#date_publication'.$i.'" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: "mm-dd-yy",
				  yearRange: "1930:2020"
				});			  
			</script>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Publications URL</h5>
			<input type="text" name="publication[url'.$i.']" placeholder="Publications URL" value="'.$arrPublication[($i-1)]['url'].'" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Description</h5>					
			<textarea name="publication[description'.$i.']" rows="6">'.$arrPublication[($i-1)]['description'].'</textarea>
			<div id="next-button" >';
				if($i < 19){
					$list .= '<input type="button" id="add_publication'.($i+1).'" class="action-button" style="float:left;" value="+ Add Publication" />';
				}
				$list .= '<input type="button" id="remove_publication'.$i.'" class="action-button" style="float:left;" value="Remove Publication" />			
			</div>	
		</div>';
	}			
	$arr = array();
	$arr['hien'] = 0;
	$arr['data'] = $list;
	if(empty($arrPublication[$i-1])){
		$arr['hien'] = 1;
	}
	echo json_encode($arr);
	exit;			
	
?>