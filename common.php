<?php
$db_server = "localhost";
	$db_user = "201605_471_g04";
	$db_password = "68WM6UZ644IP";
	$db_name = "201605_471_g04";

	function db_open()	{
		global $link, $db_server, $db_user, $db_password, $db_name;
		$link = @mysqli_connect($db_server, $db_user, $db_password, $db_name)
					or die("Could not connect: " . mysqli_connect_error());
	}

	function db_close()	{
		global $link;
		@mysqli_close($link);
	}
?>
