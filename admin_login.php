<!-- Admin login Screen provided by Dr Krish Narayanan via canvas -->
<!DOCTYPE HTML>
<head>
<title>Admin Login</title>
</head>
<?php
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$user_name = $_POST["adminname"];
$pin = $_POST["pin"];

		if ($pin == "group4" && $user_name == "admin"){
			header('Location: admin_view.php');
		} else {
			$error = "Invalid Username/password";
		}
	}

?>
<body>
<table align="center" style="border:2px solid blue;">
		<form action="" method="post" id="adminlogin_screen">
		<tr>
			<td align="right">
				Adminname<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" name="adminname" id="adminname">
			</td>
			<td align="right">
				<input type="submit" name="login" id="login" value="Login">
			</td>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" name="pin" id="pin">
			</td>
			</form>
			<form action="screen1.php" method="post" id="login_screen">
			<td align="right">
				<input type="submit" name="cancel" id="cancel" value="Cancel">
			</td>
			</form>
		</tr>

</body>
<?php echo "<table align='center'> <td align='right'><span style='color:red'>" . $error . "</span></td></table>" ?>


</html>
</html>
