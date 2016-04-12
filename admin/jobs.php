<?php
require("../config.php");
require ('admin_common.php');

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>Manage Jobs</title>
<script language="javascript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
</head>
<body>
<h3>Manage Jobs</h3>
<?php 
	if(!empty($_GET['del'])){
		$count = mysql_num_rows(mysql_query("select * from jobs where id = ".$_GET['del']));
		if($count == 1){
			$res = mysql_query("delete from jobs where id = ".$_GET['del']);			
			if($res){				
				echo "<p style='color:green; font-style: italic;'>Delete success!</p>";
			}else{
				echo "<p style='color:red; font-style: italic;'>Delete fail!</p>";				
			}
		}
	}
?>
<?php 
	if(!empty($_GET['a'])){
		$count = mysql_num_rows(mysql_query("select * from jobs where id = ".$_GET['a']));
		if($count == 1){
			$res = mysql_query("update jobs set status = 1 where id = ".$_GET['a']);			
			if($res){				
				echo "<p style='color:green; font-style: italic;'>Approved success!</p>";
			}else{
				echo "<p style='color:red; font-style: italic;'>Approved fail!</p>";				
			}
		}
	}
?>
<?php 
	if(!empty($_GET['b'])){
		$count = mysql_num_rows(mysql_query("select * from jobs where id = ".$_GET['b']));
		if($count == 1){
			$res = mysql_query("update jobs set status = 0 where id = ".$_GET['b']);			
			if($res){				
				echo "<p style='color:green; font-style: italic;'>Unset Approved success!</p>";
			}else{
				echo "<p style='color:red; font-style: italic;'>Unset Approved fail!</p>";				
			}
		}
	}
?>


<?php 
      $sql = "SELECT * FROM jobs where id_user = 0 and lfj = 1 order by id desc";
      $result = mysql_query($sql) or die(mysql_error());
?>
       <table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">
          <tr>
            <td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Title</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Job Name</strong></font></td>
            <td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Bussines Type</strong></font></td>
            <td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Address</strong></font></td>            
            <td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Description</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Date Added</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Views</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Status</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Action</strong></font></td>
        </tr>
        <?php
             while($row = mysql_fetch_assoc($result)){
        ?>
       
        <tr>
            <td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['title']; ?></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['job']; ?></font></td>
            <td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['type']; ?></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['location']; ?></font></td>
            <td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo substr(strip_tags($row['description']),0,200); ?></font></td>
            <td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo date('m-d-Y',$row['dateadded']); ?></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['views']; ?></font></td>            
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php if($row['status'] == 0){ echo 'Not Approved'; }
			if($row['status'] == 1){ echo 'Approved'; }
			?></font></td>            
            <td  bgcolor="#e6f2ea">
				<?php 
					if($row['status'] == 0){
				?>
				<font face="Verdana" size="1"><a href="jobs.php?a=<?php echo $row['id']; ?>">Approved</a></font>
				<?php }
					if($row['status'] == 1){
				?>
				<font face="Verdana" size="1"><a href="jobs.php?b=<?php echo $row['id']; ?>">Unset Approved</a></font>
				
				<?php } ?>
				/
				<font face="Verdana" size="1"><a onclick="return confirm('Do you want delete this job #<?php echo $row['id']; ?>');" href="jobs.php?del=<?php echo $row['id']; ?>">Delete</a></font>
			</td>
        </tr>
        <?php
            }
        ?>
      </table>
<div style="clear:both;"></div>
<p>&nbsp;</p>
</body>