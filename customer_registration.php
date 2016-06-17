<!-- Customer registration Screen provided by Dr Krish Narayanan via canvas -->
<!-- UI: Prithviraj Narahari, php code: Alexander Martens -->
<?php
	session_start();
	require_once("common.php");
	$error = "";
	// include common variables and functions
	if(isset($_POST['register_submit'])){

		// open the database
		db_open();

		foreach($_POST as $key => $value){
			if(empty($value)){
				$error = $key . " not entered.  Please make sure all fields are filled";
				break;
			}
		}

		if($_POST['pin'] != $_POST['retype_pin'])
			$error = "pins do not match.  Please try again";

		if(empty($error)){
			$sql ="SELECT *
				   FROM users
				   WHERE user_name = '$_POST[username]'";
			$result = mysqli_query($link,$sql);
			if($result->num_rows > 0)
    			$error = "Username already exists.  Please choose a different user name";
			else{
				$exp = date('Y-m-d', mktime(0, 0, 0, substr($_POST['expiration'], 0, 2), 1, substr($_POST['expiration'], -2)));
    			$sql="INSERT INTO users values('$_POST[username]','$_POST[pin]','$_POST[firstname]',
    					'$_POST[lastname]','$_POST[address]','$_POST[city]','$_POST[state]',
    					'$_POST[zip]', '$_POST[credit_card]', '$_POST[card_number]', '$exp')";
				echo $sql;
    			if (!mysqli_query($link,$sql))
        			$error = "User could not be added";
							else{
								$_SESSION['current_user'] = $_POST['username'];
							if ($_POST['checkout'] == 'checkout')	{
								header("Location: proof_purchase.php");
							}	else	{
								header("Location: screen2.php");
							}
		        		}
			}
		}
	}
	else if(isset($_POST['donotregister'])){
		header("Location: no_register.php");
	}
	echo $error;
	db_close();
	
?>

<HTML>
<head>
<title> CUSTOMER REGISTRATION </title>
</head>
<body>
	<table align="center" style="border:2px solid blue;">
		<tr>
			<form id="register" action="" method="post">
			<?php 
				if (isset($_GET["checkout_submit"]))	{
					echo "<input type='hidden' name='checkout' value='checkout'>";
				}
			?>
			<td align="right">
				Username<span style="color:red">*</span>:
			</td>
			<td align="left" colspan="3">
				<input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" placeholder="Enter your username">
			</td>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="pin" name="pin" >
			</td>
			<td align="right">
				Re-type PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="retype_pin" name="retype_pin">
			</td>
		</tr>
		<tr>
			<td align="right">
				Firstname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="firstname" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" placeholder="Enter your firstname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Lastname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="lastname" name="lastname" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" placeholder="Enter your lastname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="address" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="city" name="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td align="left">
				<select id="state" name="state">
				<option selected disabled>select a state</option>
				<option value="MI"
 					<? if($varGender=="MI") echo(" selected=\"selected\"");?> Michigan</option>
				<option value="CA"
 					<? if($varGender=="CA") echo(" selected=\"selected\"");?> California</option>
				<option value="TN"
 					<? if($varGender=="TN") echo(" selected=\"selected\"");?> Tennessee</option>
				</select>
			</td>
			<td align="right">
				Zip<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" id="zip" name="zip" value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : '' ?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>
			</td>
			<td align="left">
				<select id="credit_card" name="credit_card">
				<option selected disabled>select a card type</option>
				<option value="VISA"
 					<? if($varGender=="VISA") echo(" selected=\"selected\"");?> VISA</option>
				<option value="MASTER"
 					<? if($varGender=="MASTER") echo(" selected=\"selected\"");?> MASTER</option>
				<option value="DISCOVER"
 					<? if($varGender=="DISCOVER") echo(" selected=\"selected\"");?> DISCOVER</option>
				</select>
			</td>
			<td colspan="2" align="left">
				<input type="text" id="card_number" name="card_number" value="<?php echo isset($_POST['card_number']) ? $_POST['card_number'] : '' ?>" placeholder="Credit card number">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration" name="expiration" value="<?php echo isset($_POST['expiration']) ? $_POST['expiration'] : '' ?>" placeholder="MM/YY">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" id="register_submit" name="register_submit" value="Register">
			</td>
			</form>
			<form id="no_registration" action="" method="post">
			<td colspan="2" align="center">
				<input type="submit" id="donotregister" name="donotregister" value="Don't Register">
			</td>
			</form>
		</tr>
	</table>
</body>
</HTML>
