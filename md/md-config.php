
<?php
$dbhost = "milliondollardesiclub.com.mysql";
$dbusername = "milliondollarde";
$dbpassword = "8qEmu7cU";
$database_name = "milliondollarde";

$connection = @mysql_connect("$dbhost","$dbusername", "$dbpassword")
	or $DB_ERROR = "Couldn't connect to server.";

$db = @mysql_select_db("$database_name", $connection)
	or $DB_ERROR = "Couldn't select database.";

 ?>
