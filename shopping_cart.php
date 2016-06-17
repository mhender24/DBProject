<?php
	@session_start();
	if(isset($_GET['checkout_submit'])){
		if(isset($_SESSION['current_user']))
			header("Location: confirm_order.php");
		else
			header("Location: customer_registration.php");
	}


	if(isset($_GET['delIsbn'])){
		for($i=0; $i<count($_SESSION['cart']); $i++){
			if($_SESSION['cart'][$i] == $_GET['delIsbn']){
				array_splice($_SESSION['cart'], $i, 1);
			}
		}
	}
?>

<!-- Shopping cart Screen provided by Dr Krish Narayanan via canvas -->
<!DOCTYPE HTML>
<head>
	<title>Shopping Cart</title>
	<script>
	//remove from cart
	function del(isbn){
		window.location.href="shopping_cart.php?delIsbn="+ isbn;
	}
	</script>
</head>
<body>
	<?php
	include 'common.php';
	db_open();
	//Checks to see if there is a cart session variable
	if(isset($_SESSION["cart"]))	{
		$cart = $_SESSION["cart"];
		$cartlength = count($cart);
		$html = "";
		$subtotal = 0;

		//Loops through the cart array
		for($i = 0; $i < $cartlength; $i++)	{
			//sql that is disgustingly run to find data based on cart ISBNs
			$sql = "SELECT title, author, ISBN, price
					FROM book
					WHERE ISBN='" . $cart[$i] . "';";

			//Puts information into html that populates table
			if ($result = mysqli_query($link, $sql))	{
				$row = mysqli_fetch_assoc($result);
				$desc = "" . $row['title'] . "<br>"
						. $row['author'] . "<br>"
						. $row['ISBN'];

				$price = $row["price"];
				$subtotal += $price;

				$html .= "<tr>
							<td width='10%'><input type='button' name='remove' value='Delete Item' onClick=del('". $row['ISBN'] . "')></td>
							<td width='60%'>" . $desc . "</td>
							<td width='10%'><input size='2' type='number' name='quantity' min='1' value='1'></td>
							<td width='10%'>$" . $price . "</td>
						</tr>";
			}

		}

	}
			db_close();
	?>


	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="center">
			<form id="checkout" action="" method="get">
					<input type="submit" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">
				</form>
			</td>
			<td align="center">
				<form id="new_search" action="screen2.php" method="post">
					<input type="submit" name="search" id="search" value="New Search">
				</form>
			</td>
			<td align="center">
				<form id="exit" action="screen1.php" method="post">
					<input type="submit" name="exit" id="exit" value="EXIT 3-B.com">
				</form>
			</td>
		</tr>
		<tr>
				<form id="recalculate" name="recalculate" action="" method="post">
			<td  colspan="3">
				<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;">
					<table align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">
						<th width='10%'>Remove</th><th width='60%'>Book Description</th><th width='10%'>Qty</th><th width='10%'>Price</th>
						<?= $html ?>
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td align="center">
					<input type="submit" name="recalculate_payment" id="recalculate_payment" value="Recalculate Payment">
				</form>
			</td>
			<td align="center">
				&nbsp;
			</td>
			<td align="center">
				Subtotal:  <?= $subtotal; ?>
			</td>
		</tr>
	</table>
</body>
