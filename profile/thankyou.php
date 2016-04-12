<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Cảm ơn Quí Thầy/Cô</title>
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
			  width: 390px;
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
  <body>
	<div style="text-align:center;">
	<img src="logo.png" width="100px;" style="margin-left:auto; margin-right:auto;" />
	<div>
    <div class="login-card">	  	 
		<p>Xin cám ơn Quí Thầy/Cô đã tham gia cập nhật thông tin cá nhân cho Phần mềm quản lý nhân sự của Trường  CĐKT Cao Thắng.</p>
		<p>Chúc Quí Thầy/Cô một ngày làm việc hiệu quả.</p>							
		<input type="button"  class="login login-submit" onclick="window.location.href='http://www.caothang.edu.vn'" style="background-color: #DC3030;" value="Kết Thúc">
		<input type="button" onclick="window.location.href='index.php'"  class="login login-submit" value="Tiếp tục chỉnh sửa">		
	</div>
	<!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->
  </body>
</html>
