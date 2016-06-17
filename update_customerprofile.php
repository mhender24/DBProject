<!-- update user Screen provided by Dr Krish Narayanan via canvas -->
<?php
	session_start();
	include 'common.php';
	db_open();
	$error = "";
	if(isset($_POST['update_submit'])){
		foreach($_POST as $key => $value){
			if(empty($value)){
				$error = $key . " not entered.  Please make sure all fields are filled";
				break;
			}
		}
		if($error == ""){
			$exp = date('Y-m-d', mktime(0, 0, 0, substr($_POST['expiration_date'], 0, 2), 1, substr($_POST['expiration_date'], -2)));
			$update_sql = 	"UPDATE users
						 	 SET pin = '" . $_POST['new_pin'] .
						 	 "', fname = '" . $_POST['firstname'] .
						 	 "', lname = '" . $_POST['lastname'] . 
						 	 "', address = '" . $_POST['address'] . 
						 	 "', city = '" . $_POST['city'] . 
						 	 "', state = '" . $_POST['state'] .
						 	 "', zip = '" . $_POST['zip'] .
						 	 "', CCtype = '" . $_POST['credit_card'] .
						 	 "', CCnum = '" . $_POST['card_number'] . 
						 	 "', CCexp = '$exp' 
						 	 WHERE user_name = '" . $_SESSION['current_user'] . "'";
			if (!mysqli_query($link,$update_sql))
				$error = "Error, could not update";		
			else
				header("Location: confirm_order.php");				 	 
		}
	}
			$sql = "SELECT *
					FROM users
					WHERE user_name ='" . $_SESSION['current_user'] ."'";
			$result =  mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($result);
?>


<!DOCTYPE HTML>
<head>
<title>UPDATE CUSTOMER PROFILE</title>

</head>
<body>
	<?php echo $error; ?>
	<form id="update_profile" action="" method="post">
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="right">
				Username: <?=$row['user_name']?>
			</td>
			<td colspan="3" align="center">
							</td>
		</tr>
		<tr>
			<td align="right">
				New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="new_pin" name="new_pin" value="<?=$row['pin']?>">
			</td>
			<td align="right">
				Re-type New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="retypenew_pin" name="retypenew_pin" value="<?=$row['pin']?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				First Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="firstname" name="firstname" value="<?=$row['fname']?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				Last Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="lastname" name="lastname" value="<?=$row['lname']?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="address" name="address" value="<?=$row['address']?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="city" name="city" value="<?=$row['city']?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td>
				<select id="state" name="state">
				<option selected disabled>select a state</option>
				<option value = "MI" <? if($row['state'] == "MI") echo(" selected=\"selected\"");  ?> Michigan </option>
				<option value = "CA" <? if($row['state'] == "CA") echo(" selected=\"selected\"");  ?> California </option>
				<option value = "TN" <? if($row['state'] == "TN") echo(" selected=\"selected\"");  ?> Tennessee </option>
				</select>
			</td>
			<td align="right">
				Zip<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="zip" name="zip" value = "<?=$row['zip']?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>:
			</td>
			<td>
				<select id="credit_card" name="credit_card">
				<option selected disabled>select a card type</option>
				<option <?php if($row['CCtype'] == "VISA") echo(" selected=\"selected\"")  ?> >VISA </option>
				<option <?php if($row['CCtype'] == "MASTER") echo(" selected=\"selected\"")  ?> >MASTER </option>
				<option <?php if($row['CCtype'] == "DISCOVER") echo(" selected=\"selected\"")  ?> >DISCOVER </option>
				</select>
			</td>
			<td align="left" colspan="2">
				<input type="text" id="card_number" name="card_number" value = "<?=$row['CCnum']?>">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration_date" name="expiration_date" value=<?php echo "'" . date('m/y', mktime(0, 0, 0, substr($row['CCexp'], 5, 2), 1, substr($row['CCexp'], 0,4))) . "'"; ?> >
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				<input type="submit" id="update_submit" name="update_submit" value="Update">
			</td>
			</form>
		<form id="cancel" action="confirm_order.php" method="post">
			<td align="left" colspan="2">
				<input type="submit" id="cancel_submit" name="cancel_submit" value="Cancel">
			</td>
		</tr>
	</table>
	</form>
</body>
</html>


<?php




?>


