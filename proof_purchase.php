<?php
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
	$cart_sql = "SELECT title, price, author
				 FROM book
				 WHERE ISBN = ";
	for($i=0; $i<count($_SESSION['cart']); $i++){
		$cart_sql .= "'" . $_SESSION['cart'][$i] . "' OR ISBN = ";
	}
	$cart_sql = substr($cart_sql, 0, strlen($cart_sql)-11);

	$cart_result = mysqli_query($link, $cart_sql);


?>

<!DOCTYPE HTML>
<head>
	<title>Proof purchase</title>
	<header align="center">Proof purchase</header>
</head>
<body>
	<table align="center" style="border:2px solid blue;">
	<form id="buy" action="" method="post">
	<tr>
	<td>
	Shipping Address:</br>
	</td>
	</tr>
	<td colspan="2">
		<?php 	echo $user_row['fname'] . " " . $user_row['lname'] . "</br>"; ?></td>
	<td rowspan="3" colspan="2">
		<b>UserID:</b><?=$user_row['user_name']?><br />
		<b>Date:</b><?php echo  " " . date('m/d/y'); ?><br />
		<b>Time:</b><?php echo " " . date('G:i:s'); ?><br />
		<b>Card Info:</b></br><?=$user_row['CCtype']?> - <?=$user_row['CCnum']?></td>
	<tr>
	<td colspan="2">
		<?php 	echo $user_row['address'] . "</br>"; ?></td>
	</tr>
	<tr>
	<td colspan="2">
		<?php 	echo $user_row['city'] . "</br>"; ?></td>
	</tr>
	<tr>
	<td colspan="2">
		<?php 	echo $user_row['state'] . ", " . $user_row['zip'] . "</br>";  ?> </td>
	</tr>
	<tr>
	<td colspan="3" align="center">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:520px;border:1px solid black;">
	<table border='1'>

		<tr><th>Book Description</th><th>Qty</th><th>Price</th></tr>
		<?php
			while($cart_row = mysqli_fetch_assoc($cart_result) ){
				echo "<tr><td>" . $cart_row['title'] . "</br><strong>BY</strong>: " . $cart_row['author'] . "</br><strong>Price:</strong> " . $cart_row['price'] . "</td><td>1</td><td>" . $cart_row['price'] . "</td></tr>";
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
		SubTotal: <?=$subtotal?></br>Shipping_Handling: <?php echo number_format($shipping, 2) ?>  </br>_______</br>Total: <?php echo ($subtotal + $shipping); ?></div>
	</td>
	</tr>
	<tr>
		<td align="right">
			<input type="submit" id="buyit" name="btnbuyit" value="Print" disabled>
		</td>
		</form>
		<td align="right">
			<form id="update" action="screen2.php" method="post">
			<input type="submit" id="update_customerprofile" name="update_customerprofile" value="New Search">
			</form>
		</td>
		<td align="left">
			<form id="cancel" action="screen1.php" method="post">
			<input type="submit" id="exit" name="exit" value="Exit 3-B.com">
			</form>
		</td>
	</tr>
	</table>
</body>
</HTML>
