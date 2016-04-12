<?php
require("../config.php");
require ('admin_common.php');

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>Manage Apply Scholarship</title>
<script language="javascript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
</head>
<body>
<h3>Manage Apply Scholarship</h3>
<?php 
	if(!empty($_GET['del'])){
		$count = mysql_num_rows(mysql_query("select * from apply_scholarship where id = ".$_GET['del']));
		if($count == 1){
			$res = mysql_query("delete from apply_scholarship where id = ".$_GET['del']);			
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
		$count = mysql_num_rows(mysql_query("select * from apply_scholarship where id = ".$_GET['a']));
		if($count == 1){
			$res = mysql_query("update apply_scholarship set status = 1 where id = ".$_GET['a']);			
			if($res){				
				echo "<p style='color:green; font-style: italic;'>Approved success!</p>";
			}else{
				echo "<p style='color:red; font-style: italic;'>Approved fail!</p>";				
			}
		}
	}
?>


<?php 
      $sql = "SELECT * FROM apply_scholarship order by id desc";
      $result = mysql_query($sql) or die(mysql_error());
?>
       <table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">
          <tr>
            <td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Id</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Name</strong></font></td>
            <td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Email</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Age</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Sex</strong></font></td>
            <td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Phone</strong></font></td>            
            <td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Location</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Academic Qualifications</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Personal Statement</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Course being Applied for</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Message</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Date Added</strong></font></td>
			<td  bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Action</strong></font></td>
        </tr>
        <tbody style="vertical-align: top;">
		<?php
             while($row = mysql_fetch_assoc($result)){
        ?>        
        <tr>
            <td width="" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['id']; ?></font></td>
			<td width="" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['name']; ?></font></td>
			<td width="" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['email']; ?></font></td>
			<td width="" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['age']; ?></font></td>
			<td width="" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php if($row['sex'] == 0){ echo "Male"; }else{ echo "Female"; } ?></font></td>            
			<td width="" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['phone']; ?></font></td>
			<td width="" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['address']; ?></font></td>            
			<td width="" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['academic_qualifications']; ?></font></td>
			<td width="" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['personal_statement']; ?></font></td>
			<td width="" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['course_being_applied_for']; ?></font></td>
			<td width="" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo substr(strip_tags($row['message']),0,200); ?></font></td>            			       			         
			<td width="" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo date('m-d-Y',$row['dateadded']); ?></font></td>
            <td width="" bgcolor="#e6f2ea">				
				<font face="Verdana" size="1"><a onclick="return confirm('Do you want delete this apply scholarship #<?php echo $row['id']; ?>');" href="apply_scholarship.php?del=<?php echo $row['id']; ?>">Delete</a></font>
			</td>
        </tr>
        <?php
            }
        ?>
		</tbody>
      </table>
<div style="clear:both;"></div>
<p>&nbsp;</p>
</body>