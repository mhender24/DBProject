<!-- Screen3 provided by Dr Krish Narayanan via canvas -->
<!-- Figure 3: Search Result Screen by Prithviraj Narahari, php coding: Alexander Martens -->
<?php
	$sql = "SELECT ISBN, title, author, publisher, price 
			FROM book 
			WHERE (";
	$keywords_arr = explode(',', $_GET['searchfor']);
	foreach($keywords_arr as $keyword){
		if($_GET['searchon'][0] == 'anywhere'){
			$sql .= "title LIKE '%" . trim($keyword) . "%' OR author LIKE '%" . trim($keyword) . "%' 
			OR publisher LIKE '%" . trim($keyword) . "%' OR ISBN LIKE '%" . trim($keyword) . "%' OR ";
		}
		else{
			foreach($_GET['searchon'] as $selected){
				$sql .= $selected . " LIKE '%" . trim($keyword) . "%' OR ";
			}
		}
	}
	$sql = substr($sql, 0, strlen($sql)-3);
	$sql .= ")";
	if($_GET['category'] != "all"){
		$sql .= " AND category = '" . $_GET['category'] . "'";
	}
	//echo $sql;
?>

<html>
<head>
	<title> Search Result - 3-B.com </title>
	<script>
	//redirect to reviews page
	function review(isbn, title){
		window.location.href="screen4.php?isbn="+ isbn + "&title=" + title;
		return false;
	}
	//add to cart
	function cart(isbn, searchfor, searchon, category){
		window.location.href="screen3.php?cartisbn="+ isbn + "&searchfor=" + $_GET['searchfor'] + "&searchon=" + $_GET['searchon'] + "&category=" + $_GET['category'];
	}
	</script>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="left">

					<h6> <fieldset>Your Shopping Cart has 0 items</fieldset> </h6>

			</td>
			<td>
				&nbsp
			</td>
			<td align="right">
				<form action="shopping_cart.php" method="post">
					<input type="submit" value="Manage Shopping Cart">
				</form>
			</td>
		</tr>
		<tr>
		<td style="width: 350px" colspan="3" align="center">
			<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;background-color:LightBlue">
			<table>
				<!--  php goes here for search results -->
				<?php
				include 'common.php';
				db_open();
				//$sql = "SELECT ISBN, title, author, publisher, price FROM book";

				if ($result = mysqli_query($link, $sql)) {
					while($row = mysqli_fetch_assoc($result) ){
						// Add cart button
						echo "<tr><td align='left'><button name='btnCart' id='btnCart' onClick='cart(". $row["ISBN"] . ", \"\", \"Array\", \"all\")'>Add to Cart</button></td>";
						// book info
						echo " <td rowspan='2' align='left'>" .$row["title"]. "</br>By " .$row["author"]. "</br><b>Publisher:</b> " .$row["publisher"]. ",</br><b>ISBN:</b> " .$row["ISBN"]. "</t> <b>Price:</b> $" .$row["price"]. "</td></tr>";
						// reviews button
				
				
						//echo "<tr><td align='left'><button name='review' id='review' onClick=\" return review('". $row['ISBN'] . ", '" . $row['title'] . "'\");" . ">Reviews</button>";
				?>
						<tr><td align='left'><button name='review' id='review' onClick="return review( <?=$row['ISBN']?>, '<?=$row['title']?>');">Reviews</button>
				<?php			
						echo "</td></tr><tr><td colspan='2'><p><hr></p></td></tr>";
					}
			}else {
				echo "<tr><p> No Results </p></tr>";
				}

			db_close();

			 ?>

		</table>
			</div>

			</td>
		</tr>
		<tr>
			<td align= "center">
				<form action="" method="get">
					<input type="submit" value="Proceed To Checkout" id="checkout" name="checkout">
				</form>
			</td>
			<td align="center">
				<form action="screen2.php" method="post">
					<input type="submit" value="New Search">
				</form>
			</td>
			<td align="center">
				<form action="screen1.php" method="post">
					<input type="submit" name="exit" value="EXIT 3-B.com">
				</form>
			</td>
		</tr>
	</table>
</body>
</html>
