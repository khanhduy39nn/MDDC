<?php
require("../config.php");
require ('admin_common.php');

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>Edit Featured Profile</title>
<script language="javascript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
</head>
<body>
<h3>List Register</h3>
<?php 
      $sql = "SELECT * FROM register";
      $result = mysql_query($sql) or die(mysql_error());
?>
       <table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">
         <tr>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>No</strong></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Name</strong></font></td>            
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Email</strong></font></td>
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Address</strong></font></td>            
			
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Phone number</strong></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Salary Bracket</strong></font></td>            
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Occupation</strong></font></td>
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Business Areas of Interest</strong></font></td>
			
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Date Added</strong></font></td>           
        </tr>
        <?php
			$i = 1;
             while($row = mysql_fetch_assoc($result)){
        ?>
       
        <tr>
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $i; ?></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['name']; ?></font></td>
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['email']; ?></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['address']; ?></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['phone']; ?></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['salary_bracket_from']."-".$row['salary_bracket_to']; ?></font></td>            
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['occupation']; ?></font></td>
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['business_areas_of_interest']; ?></font></td>            
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo date('m-d-Y',$row['dateadded']); ?></font></td>
        </tr>
        <?php
			$i++;
            }
        ?>
      </table>
<div style="clear:both;"></div>
<p>&nbsp;</p>
</body>