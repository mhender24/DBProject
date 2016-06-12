<?php
	$db_server = "localhost";
	$db_user = "root";
	$db_password = "Natalie0821";
	$db_name = "dbproject";
		
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