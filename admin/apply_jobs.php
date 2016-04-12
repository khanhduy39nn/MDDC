<?php
require("../config.php");
require ('admin_common.php');

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>Manage Apply Jobs</title>
<script language="javascript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
</head>
<body>
<h3>Manage Apply Jobs</h3>

<?php 
      $sql = "SELECT * FROM apply_jobs";
      $result = mysql_query($sql) or die(mysql_error());
?>
       <table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">
          <tr>            
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Name Apply</strong></font></td>			
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Email Apply</strong></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Phone Apply</strong></font></td>            
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Emails to</strong></font></td>				
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Subject</strong></font></td>					
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Message</strong></font></td>								
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><strong>Attach CV</strong></font></td>	
          </tr>
        <?php
             while($row = mysql_fetch_assoc($result)){
        ?>       
        <tr>            
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['name_apply']; ?></font></td>
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['email_apply']; ?></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['phone_apply']; ?></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['email_to']; ?></font></td>			
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['subject']; ?></font></td>					
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['message']; ?></font></td>											
			<td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><a href="http://milliondollardesiclub.com/upload_attachs/<?php echo $row['cv']; ?>" target="_blank">http://milliondollardesiclub.com/upload_attachs/<?php echo $row['cv']; ?></a></font></td>            			
        </tr>
        <?php
            }
        ?>
      </table>
<div style="clear:both;"></div>
<p>&nbsp;</p>
</body>