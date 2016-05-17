<!-- Confirm order Screen provided by Dr Krish Narayanan via canvas -->
<!DOCTYPE HTML>
<head>
	<title>CONFIRM ORDER</title>
	<header align="center">Confirm Order</header>
</head>
<body>
	<table align="center" style="border:2px solid blue;">
	<form id="buy" action="" method="post">
	<tr>
	<td>
	Shipping Address:
	</td>
	</tr>
	<td colspan="2">
		k n	</td>
	<td rowspan="3" colspan="2">
		<input type="radio" name="cardgroup" value="profile_card" checked>Use Credit card on file<br />VISA - 1234567890123456 - 03/19<br />
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
		65 ff st	</td>
	</tr>
	<tr>
	<td colspan="2">
		bri	</td>
	</tr>
	<tr>
	<td colspan="2">
		Michigan, 48114	</td>
	</tr>
	<tr>
	<td colspan="3" align="center">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:520px;border:1px solid black;">
	<table border='1'>
		<th>Book Description</th><th>Qty</th><th>Price</th>
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
		SubTotal:$0</br>Shipping_Handling:$0</br>_______</br>Total:$0	</div>
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
			<form id="cancel" action="screen1.php" method="post">
			<input type="submit" id="cancel" name="cancel" value="Cancel">
			</form>
		</td>
	</tr>
	</table>
</body>
</HTML>
