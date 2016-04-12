<?php
session_start();
include ("../config.php");
include ("login_functions.php");

require ("header.php");

$sql = "select block_id from blocks where user_id='".$_SESSION['MDS_ID']."' and status='sold' ";
$result = mysql_query($sql) or die(mysql_error());
$pixels = mysql_num_rows($result) * 100;

?>
<h3>Login User</h3>

<form name="form1" method="post" action="login.php?target_page=index.php">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-color:#000;">
		<tbody><tr>
			<td class="boc" width="50%" nowrap=""><span>Member ID:</span></td>
			<td class="boc"><input name="Username" type="text" id="username" size="12"></td>
		</tr>
		<tr>
			<td class="boc" width="50%"><span>Password:</span></td>
			<td class="boc"><input name="Password" type="password" id="password" size="12"></td>
		</tr>
		<tr>
			<td class="boc" width="50%">&nbsp;</td>
			<td class="boc"><div align="right"><span>
				<input type="submit" class="form_submit_button" name="Submit" value="Login" <="" span="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
			</td>
		</tr>
		  <tr><td class="boc" colspan="2"><a href="forgot.php">Forgotten your Password</a></td></tr>
		</tbody></table>
</form>
<?php

require ("footer.php");
?>