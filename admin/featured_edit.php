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

<h3>Edit Featured Profile</h3>
<br>
<br>
<?php 
    if(!empty($_POST)){
        if(empty($_POST['title']) || empty($_POST['content'])){
            echo "<p style='color:red; font-style: italic;'>Title and Content are required</p>";
        }else{
            $sql = "SELECT * FROM featured";
        	$result = mysql_query($sql) or die(mysql_error());
	        $count_featured = mysql_num_rows($result);
	        if($count_featured == 0){
	             $res = mysql_query('INSERT INTO featured ( title, content) VALUES ("'.$_POST['title'].'","'.$_POST['content'].'")');
            }else if($count_featured == 1) {
                $featured_old = mysql_fetch_assoc($result);
                $sql = 'UPDATE featured SET title = "'.$_POST['title'].'" , content = "'.$_POST['content'].'" WHERE id = '.$featured_old['id'];
                $res = mysql_query($sql);
            }
            if($res){
               echo "<p style='color:green; font-style: italic;'>Add success!</p>";
            }else{
                echo "<p style='color:red; font-style: italic;'>Add Fail!</p>";
            }
        }
    }
?>
<?php 
    $sql = "SELECT * FROM featured ";
	$result = mysql_query($sql) or die(mysql_error());
    $featured = mysql_fetch_assoc($result);
?>
<form method="POST" name="form1">
  <p>&nbsp;</p>
  <table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">
     <tr>
      <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">Main Image</font></td>
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
      <input type="file" name="myfile" style="width:400px;" value="" /></font></td>
    </tr>
    <tr>
      <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">Title</font></td>
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
      <input type="text" name="title" style="width:400px;" value="<?php if(!empty($featured['title'])){ echo $featured['title']; } ?>" /></font></td>
    </tr>
    <tr>
      <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">Author</font></td>
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
      <input type="text" name="author" style="width:400px;" value="" /></font></td>
    </tr>
    <tr>
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">Content</font></td>
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
     <textarea name="content" cols="30" rows="4" id="content" ><?php if(!empty($featured['content'])){ echo $featured['content']; } ?></textarea>
     <script type="text/javascript"> CKEDITOR.replace('content'); </script>
      </font></td>
    </tr>
  </table>
  <p><font size="1" face="Verdana"><input type="submit" value="Save" name="save"></font></p>
</form>

<p>&nbsp;</p>
</body>