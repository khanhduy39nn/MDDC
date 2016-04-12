<?php
	include 'config.php';
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Đăng Nhập Phần Mềm Quản Lý Nhân Sự</title>
    <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
	 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
        <!--<link rel="stylesheet" href="css/style.css">-->
		<style>
			@import url(http://fonts.googleapis.com/css?family=Roboto:400,100);

			body {
			  background: #fff; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			  font-family: 'Roboto', sans-serif;
			}

			.login-card {
			  padding: 40px;
			  width: 274px;
			  background-color: #F7F7F7;
			  margin: 0 auto 10px;
			  border-radius: 2px;
			  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			  overflow: hidden;
			}

			.login-card h1 {
			  font-weight: 100;
			  text-align: center;
			  font-size: 2.3em;
			}

			.login-card input[type=submit] {
			  width: 100%;
			  display: block;
			  margin-bottom: 10px;
			  position: relative;
			}

			.login-card input[type=text], input[type=password], select {
			  height: 44px;
			  font-size: 16px;
			  width: 100%;
			  margin-bottom: 10px;
			  -webkit-appearance: none;
			  background: #fff;
			  border: 1px solid #d9d9d9;
			  border-top: 1px solid #c0c0c0;
			  /* border-radius: 2px; */
			  padding: 0 8px;
			  box-sizing: border-box;
			  -moz-box-sizing: border-box;
			}

			.login-card input[type=text]:hover, input[type=password]:hover {
			  border: 1px solid #b9b9b9;
			  border-top: 1px solid #a0a0a0;
			  -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
			  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
			  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
			}

			.login {
			  text-align: center;
			  font-size: 14px;
			  font-family: 'Arial', sans-serif;
			  font-weight: 700;
			  height: 36px;
			  padding: 0 8px;
			/* border-radius: 3px; */
			/* -webkit-user-select: none;
			  user-select: none; */
			}

			.login-submit {
			  /* border: 1px solid #3079ed; */
			  border: 0px;
			  color: #fff;
			  text-shadow: 0 1px rgba(0,0,0,0.1); 
			  background-color: #4d90fe;
			  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
			}

			.login-submit:hover {
			  /* border: 1px solid #2f5bb7; */
			  border: 0px;
			  text-shadow: 0 1px rgba(0,0,0,0.3);
			  background-color: #357ae8;
			  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
			}

			.login-card a {
			  text-decoration: none;
			  color: #666;
			  font-weight: 400;
			  text-align: center;
			  display: inline-block;
			  opacity: 0.6;
			  transition: opacity ease 0.5s;
			}

			.login-card a:hover {
			  opacity: 1;
			}

			.login-help {
			  width: 100%;
			  text-align: center;
			  font-size: 12px;
			}
		</style>

    
    
    
  </head>
  <?php 
	if(!empty($_POST)){
		$data = $_POST;
		if(isset($data['id_nv']) && $data['id_nv'] != 'NULL'  && !empty($data['pass'])){
			$rs = mysql_query("select * from nhan_vien where MVC = ".$data['id_nv']." and pass ='".md5($data['pass'])."'");
			if(mysql_num_rows($rs) == 1){
				$_SESSION['login_qlns'] = "YES";
				$_SESSION['id_nv'] = $data['id_nv'];
				header("Location: index.php");
				exit;
			}
		}
	}
	$bomon = mysql_query("SELECT MaBMBP, TenBMBP FROM bomonbophan ORDER BY MaBMBP ASC");		
	
  ?>
  <body>
	<div style="text-align:center;">
	<img src="logo.png" width="100px;" style="margin-left:auto; margin-right:auto;" />
	<div>
    <div class="login-card" style="padding-top: 10px;padding-bottom: 10px;">	  
	  <h2 style="font-weight:200;">Phần Mềm</h2>
	  <h1 style="font-weight:bold;font-size: 35px;">Quản Lý Nhân Sự</h1><br>	 
	  <form action="" method="post">
		<select id="id_bmbp" name="id_bmbp">
			<option value="NULL">--Chọn Bộ Môn Bộ Phận</option>			
			<?php 
				while($row = mysql_fetch_assoc($bomon))
				{
				?>	
					<option value="<?php echo $row['MaBMBP']; ?>"><?php echo $row['TenBMBP']; ?></option>	
				<?php			
				}
			?>
		</select>
		<select id="nhan_vien" name="id_nv" style="display:none;">
									
		</select>
		<script>
			$("#id_bmbp").change(function(){ 				
				$.ajax({
						type: 'get',
						dataType: 'text',
						url: 'ajax_nv.php',
						data: {bmbp: $("#id_bmbp").find(":selected").val()},
						success: function(result)
						{			
							$("#nhan_vien").show();
							$("#nhan_vien").html(result);
						}
				});
			});
		</script>
		<input type="password" name="pass" placeholder="Mật Khẩu">
		<input type="submit" name="login" class="login login-submit" value="Đăng Nhập">
	  </form>      
	</div>
	<div>
		Phần mềm tương thích tốt nhất với trình duyệt Google Chrome và Firefox.<br> 
		Quí Thầy Cô vui lòng nhấn vào đây để tải bản mới nhất của trình duyệt Google Chrome (<a target="_blank" href="https://www.google.com/chrome/browser/desktop/index.html">link download</a>) và Firefox (<a target="_blank" href="https://www.mozilla.org/vi/firefox/new/">link download</a>)<br>
Mọi thắc mắc xin gửi mail về: <a href="mailto:phanmemckc@gmail.com">phanmemckc@gmail.com</a> kèm theo số điện thoại liên hệ. <br>
Xin cám ơn Quí Thầy/Cô.<br>
Nhóm Phần Mềm Trường CĐKT Cao Thắng<br>
	</div>
	<!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->
  </body>
</html>
