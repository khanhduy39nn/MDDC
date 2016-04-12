<?php
require("../config.php");
require ('admin_common.php');

?>

<?php 
    
        if(!empty($_POST)){
            if(empty($_POST['title']) || empty($_POST['content'])){
                echo "<p style='color:red; font-style: italic;'>Title and Content are required</p>";
            }else{
                //upload image
                $name = '';
               
                if($_FILES['myfile']['name'] != NULL){ 
                    if($_FILES['myfile']['type'] == "image/jpeg"
                    || $_FILES['myfile']['type'] == "image/png"
                    || $_FILES['myfile']['type'] == "image/gif"){
                        if($_FILES['file']['size'] > 1048576){
                            echo "File no larger than 1mb";
                        }else{
                            $tmp_name = $_FILES['myfile']['tmp_name'];
                            $name = time().$_FILES['myfile']['name'];
                            $type = $_FILES['myfile']['type']; 
                            $size = $_FILES['myfile']['size']; 
                            // Upload file
                            move_uploaded_file($tmp_name,'../upload_files/images/'. $name);
                       }
                    }else{
                       echo "Invalid file type";
                        }
                   }else{
                        echo "Please add main imagefile";
                   }
                if($_POST['id_feat'] != ''){
                    echo '1';
                    $featured_old = mysql_fetch_assoc($result);
                        $sql = 'UPDATE featured SET title = "'.$_POST['title'].'" , content = "'.$_POST['content'].'", image = "'.$name.'", author = "'.$_POST['author'].'" WHERE id = '.$_POST['id_feat'];
                        
                        $res = mysql_query($sql);
                }else{
                    echo '2';
                     $res = mysql_query('INSERT INTO featured (title, content, image, author, dateadded) VALUES ("'.$_POST['title'].'","'.$_POST['content'].'","'.$name.'","'.$_POST['author'].'",'.time().')'); 
                }
                if($res){
                   echo "<p style='color:green; font-style: italic;'>Success!</p>";
                }else{
                    echo "<p style='color:red; font-style: italic;'>Fail!</p>";
                }
            }
        }
 
if(!empty($_GET['delete'])){
    $sql = "SELECT * FROM featured WHERE id = ".$_GET['delete'];
    $result = mysql_query($sql) or die(mysql_error());
    $count_featured = mysql_num_rows($result);
    if($count_featured == 1){
        $sql = "Delete FROM featured WHERE id =".$_GET['delete'];
        $res = mysql_query($sql) or die(mysql_error());
        if($res){
             echo "<p style='color:green; font-style: italic;'>Delete success!</p>";
        }else{
             echo "<p style='color:red; font-style: italic;'>Delete fail!</p>";
        }
    }
}
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>Edit Featured Profile</title>
<script language="javascript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
</head>
<body>
<h3>List Featured Profile</h3>
<?php 
      $sql = "SELECT * FROM featured";
      $result = mysql_query($sql) or die(mysql_error());
?>
       <table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">
         <tr>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">ID</font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">Title</font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">Author</font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">Added</font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">Action</font></td>
        </tr>
        <?php
             while($row = mysql_fetch_assoc($result)){
        ?>
       
        <tr>
          <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['id']; ?></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['title']; ?></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo $row['author']; ?></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><?php echo date('m-d-Y',$row['dateadded']); ?></font></td>
            <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1"><a href="featured.php?id_feat=<?php echo $row['id']; ?>">Edit</a></font>
            <font face="Verdana" size="1"><a href="featured.php?delete=<?php echo $row['id']; ?>">Delete</a></font></td>
        </tr>
        <?php
            }
        ?>
      </table>




<h3>Add/Edit Featured Profile</h3>
<br>
<br>
<?php

if(!empty($_GET['id_feat'])){
    $sql = "SELECT * FROM featured WHERE id = ".$_GET['id_feat'];
	$result = mysql_query($sql) or die(mysql_error());
    $featured = mysql_fetch_assoc($result);
}
?>
<form method="POST" name="form1" enctype="multipart/form-data">
    <input type="hidden" name="id_feat" value="<?php echo $featured['id']; ?>" />
  <p>&nbsp;</p>
  <table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">
     <tr>
      <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">Main Image</font></td>
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
      <input type="file" name="myfile" style="width:400px;" value="" /></font><br>
      <?php if(isset($featured['image'])){ ?>
      <img src="../upload_files/images/<?php echo $featured['image']; ?>" width="150px" height="150px" /></td>
      <?php } ?>
    </tr>
    <tr>
      <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">Title</font></td>
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
      <input type="text" name="title" style="width:400px;" value="<?php if(!empty($featured['title'])){ echo $featured['title']; } ?>" /></font></td>
    </tr>
    <tr>
      <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">Author</font></td>
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
      <input type="text" name="author" style="width:400px;" value="<?php if(!empty($featured['author'])){ echo $featured['author']; } ?>" /></font></td>
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