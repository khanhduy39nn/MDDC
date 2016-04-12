<?php
include ("../config.php");
include ("login_functions.php");
require ("../header_page.php");
?>

<link href="css/style.css" type="text/css" rel="Stylesheet" />
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<div class="block">
	<h1>Stay in touch with your contacts who aren't on MDDC yet. Invite them to connect with you.</h1><br/>
	<?php
		if(isset($_GET['provider'])&&$_GET['provider']=='twitter'){
			echo '<form name="sendmail" action="openid/?serviceid=1&connect" method="post" >';
		}else{
				echo '<form name="sendmail" action="?step=3" method="post" >';
		}
	?>
	 <input type="button" id="checkAll" value="Check all/Uncheck all" style="background-color: #BEAA4B;width: 150px;height: 20px;color:#D8E378 !important;" />
	 <input type="submit" id="invite" name ="invite" value="Invite" style="background-color: #BEAA4B;width: 80px;height: 20px;color:#D8E378 !important;" />
	 <input type="hidden" id="provider" name ="provider" value="<?php if(isset($_GET['provider'])) echo $_GET['provider'];  ?>" />
	 <input type="hidden" id="connect" name ="connect" value="connect" />

		<?php
		if(isset($_GET['provider'])&&$_GET['provider']=='twitter'&&isset($_GET['msg'])){
			$msg= base64_decode($_GET['msg']);
		?>
	 		<textarea type="text" style="display:none;" id="tw-message" name="tw-message"><?php echo $msg; ?></textarea>
	 <?php } ?>

	 <br />

	 <ul class="friend_picker">
		<?
			if(isset($_GET['data'])){
				$sql="select * from user_contactlists_temp where TempID=".trim($_GET['data']);
			//	echo $sql;
				$friends = mysql_query($sql);

				if(mysql_num_rows($friends) == 1){
					$friends=mysql_fetch_assoc($friends);
					$friends=explode(",",$friends['ContactList']);
					$count=count($friends);

					$i=1;
					if($count>0){
						while ($i < $count):
							$name='';
							$id='';
							if($_GET['provider']!='twitter'){
								$name=$friends[$i];
								$id=$friends[$i];
							}
							else {
								$kq=explode(".",$friends[$i]);
								$name=$kq[1];
								$id=$kq[0];
							}

							echo '<li><input name="friend[]" checked="true" class="chkaction"  type="checkbox" id="'.$id.'" value="'.$id.'" />
							  <label for="'.$id.'">
								<img src="images/default-avatar.png" />';
							echo '<p style="line-height:0px;">'.$name.'</p>';
							echo'  </label>
							</li>';
							$i++;
						endwhile;
					}else{
						echo "<li>empty list</li>";
					}

				}else{
					echo "<li>empty list</li>";
				}
			}
		?>
      </ul>
	</form>
</div>
<?php
$sql = 'delete from user_contactlists_temp where UserID='.$_SESSION['detail']['id'];
mysql_query($sql);
require ("../users/footer.php");
?>
