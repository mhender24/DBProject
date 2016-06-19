<!-- Confirm order Screen provided by Dr Krish Narayanan via canvas -->
<?php
	$error = "";

	date_default_timezone_set('America/Detroit');
	session_start();
	include 'common.php';
	db_open();
	$user_sql = "SELECT user_name, fname, lname, address, city, state, zip, CCtype, CCnum
			FROM users
			WHERE user_name = '" . $_SESSION['current_user'] ."'";
	$user_result = mysqli_query($link, $user_sql);
	$user_row = mysqli_fetch_assoc($user_result);

	//$cart_sql = "SELECT b.title, b.price, c.quantity
	//			 FROM book as b natural join order_contents as c
	//			 WHERE ISBN = ";
	$subtotal = 0.0;
	$shipping = 2.00 * count($_SESSION['cart']);
	$cart_sql = "SELECT title, price, author, ISBN
				 FROM book
				 WHERE ISBN = ";
	for($i=0; $i<count($_SESSION['cart']); $i++){
		$cart_sql .= "'" . $_SESSION['cart'][$i] . "' OR ISBN = ";
	}
	$cart_sql = substr($cart_sql, 0, strlen($cart_sql)-11);

	$cart_result = mysqli_query($link, $cart_sql);

	if(isset($_POST['btnbuyit'])){
		while($cart_row = mysqli_fetch_assoc($cart_result) ){
			$subtotal += $cart_row['price'];
		}
		$total = $subtotal + $shipping;
		$randid = rand(1, 99999999);
		$insert_sql = "INSERT INTO orders
						VALUES('" . $randid . "', '". $user_row['user_name'] . "', '" . date('Y-m-d') . "', " . $total .
							")";
		if (!mysqli_query($link,$insert_sql))
			$error = "Could not complete order.";
		else	{
			for ($i = 0; $i < $_SESSION["cart"]; $i++)	{
				$content_sql = "INSERT INTO order_contents
								VALUES('" . $randid . "', '" . $_SESSION['cart'][$i] . "', " . $_SESSION['quantities'][$i] . ");";
				mysqli_query($link, $content_sql);
			}
			header("Location: proof_purchase.php");
		}
	}
	
	$cartlink = array();
	for ($i = 0; $i < count($_SESSION["cart"]); $i++)	{
		$cartlink[$_SESSION["cart"][$i]] = $_SESSION["quantities"][$i];
	}
?>

<!DOCTYPE HTML>
<head>
	<title>CONFIRM ORDER</title>
	<header align="center">Confirm Order</header>
</head>
<body>
	<?php echo $error ?>
	<table align="center" style="border:2px solid blue;">
	<form id="buy" action="" method="post">
	<tr>
	<td>
	Shipping Address:
	</td>
	</tr>
	<td colspan="2">
		<?php echo $user_row['fname'] . " " . $user_row['lname']; ?></td>
	<td rowspan="3" colspan="2">
		<input type="radio" name="cardgroup" value="profile_card" checked>Use Credit card on file<br /><?php echo $user_row['CCtype'] . " - " . $user_row['CCnum']; ?><br />
		<input type="radio" name="cardgroup" value="new_card">New Credit Card<br />
				<select id="credit_card" name="credit_card">
					<option selected disabled>select a card type</option>
					<option>VISA</option>
					<option>MASTER</option>
					<option>DISCOVER</option>
				</select>
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number">
				<br />Exp date<input type="text" id="card_expiration" name="card_expiration" placeholder="mm/yyyy">
	</td>
	<tr>
	<td colspan="2">
		<?=$user_row['address']?></td>
	</tr>
	<tr>
	<td colspan="2">
		<?=$user_row['city']?></td>
	</tr>
	<tr>
	<td colspan="2">
		<?php echo $user_row['state'] . ", " . $user_row['zip']?></td>
	</tr>
	<tr>
	<td colspan="3" align="center">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:520px;border:1px solid black;">
	<table border='1'>
		<th>Book Description</th><th>Qty</th><th>Price</th>
		<?php
			while($cart_row = mysqli_fetch_assoc($cart_result) ){
				$price = ($cart_row['price'] * $cartlink[$cart_row['ISBN']]);
				echo "<tr><td>" . $cart_row['title'] . "</br><strong>BY</strong>: " . $cart_row['author'] . "</br><strong>Price:</strong> " . $cart_row['price'] . "</td><td>" . $cartlink[$cart_row['ISBN']] . "</td><td>" . $price . "</td></tr>";
				$subtotal += $cart_row['price'];

			}
		?>
			</table>
	</div>
	</td>
	</tr>
	<tr>
	<td align="left" colspan="2">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:260px;border:1px solid black;background-color:LightBlue">
	<b>Shipping Note:</b> The book will be </br>delivered within 5</br>business days.
	</div>
	</td>
	<td align="right">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:260px;border:1px solid black;">
		SubTotal: <?=$subtotal?></br>Shipping & Handling: <?php echo number_format($shipping, 2) ?>  </br>_______</br>Total: <?php echo ($subtotal + $shipping); ?></div>
	</td>
	</tr>
	<tr>
		<td align="right">
			<input type="submit" id="buyit" name="btnbuyit" value="BUY IT!">
		</td>
		</form>
		<td align="right">
			<form id="update" action="update_customerprofile.php" method="post">
			<input type="submit" id="update_customerprofile" name="update_customerprofile" value="Update Customer Profile">
			</form>
		</td>
		<td align="left">
			<form id="cancel" action="screen2.php" method="post">
			<input type="submit" id="cancel" name="cancel" value="Cancel">
			</form>
		</td>
	</tr>
	</table>
</body>
</HTML>
