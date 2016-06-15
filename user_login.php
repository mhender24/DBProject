<!-- user login Screen provided by Dr Krish Narayanan via canvas -->
<!DOCTYPE HTML>
<head>
<title>User Login</title>
</head>
<body>
	<?php


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_name = $_POST["username"];
	$pin = $_POST["pin"];
	$sql = "SELECT pin
			FROM users
			WHERE user_name = " . $user_name;
	include 'common.php';
	db_open();


	if ($result = mysqli_query($link, $sql)) {
		$row = mysqli_fetch_assoc($result);
			if ($row["pin"] === $pin){
				session_start();
				$_SESSION['current_user'] = $_POST['username'];
				header('Location: screen2.php');
			} else {
				header('Location: user_login.php');
				$error = "Invalid Username/password";
			}
		}
	}
	db_close();
	?>
	<table align="center" style="border:2px solid blue;">

		<form action="<?php  ?>" method="post" id="login_screen">
		<tr>
			<td align="right">
				Username<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" name="username" id="username">
			</td>
			<td align="right">
				<input type="submit" name="login" id="login" value="Login" >
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
	</table>
	<?php echo $error ?>
</body>

</html>
