<!-- Screen3 provided by Dr Krish Narayanan via canvas -->
<!-- Figure 3: Search Result Screen by Prithviraj Narahari, php coding: Alexander Martens -->
<?php
	$sql = "SELECT ISBN, title, author, publisher, price 
			FROM book 
			WHERE ";

	if($_GET['searchon'][0] == 'anywhere'){
		$sql .= "title LIKE '%" . $_GET['searchfor'] . "%' OR author LIKE '%" . $_GET['searchfor'] . "%' 
		OR publisher LIKE '%" . $_GET['searchfor'] . "%' OR ISBN LIKE '%" . $_GET['searchfor'] . "%' OR ";
	}
	else{
		foreach($_GET['searchon'] as $selected){
			$sql .= $selected . " LIKE '%" . $_GET['searchfor'] . "%' OR ";
		}
	}
	$sql = substr($sql, 0, strlen($sql)-3);
	if($_GET['category'] != "all"){
		$sql .= " AND category = '" . $_GET['category'] . "'";
	}
	//echo $sql;
	
	//Session work for cart
	session_start();
	if (!isset($_SESSION["cart"]))	
		$_SESSION["cart"] = array();

	if(isset($_GET['cartisbn']))
		@array_push($_SESSION["cart"], $_GET["cartisbn"]);

	$incart = count($_SESSION["cart"]);
	
	
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
		var url = "screen3.php?cartisbn="+ isbn + "&searchfor=" + searchfor;
		for(var i=0; i<searchon.length; i++){//in sch){
			url += "&searchon[]=" + searchon[i];
		}
		url += "&category=" + category;
		window.location.href = url;
		return false;
	}
	</script>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="left">

					<h6> <fieldset>Your Shopping Cart has <?= $incart; ?> items</fieldset> </h6>

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

				if ($result = mysqli_query($link, $sql)) {
					while($row = mysqli_fetch_assoc($result) ){
						// Add cart button

				?>
						<script type ="text/javascript">
							var arr = <?php echo json_encode($_GET['searchon']); ?>;
							var size = <?php echo count($_SESSION['cart']); ?>;
							var cart_arr = <?php echo json_encode($_SESSION['cart']); ?>;
							var row ='<?= $row['ISBN'] ?>';
						</script> 
						<tr><td align='left'><button name='btnCart' class='btnCart' onClick="return cart('<?=$row['ISBN']?>', '<?=$_GET['searchfor']?>', arr, '<?=$_GET['category']?>')">Add to Cart</button></td>
						
						<script type = "text/javascript"> 	
							var elems = document.getElementsByClassName("btnCart"); 
							for(var i=0; i<elems.length; i++){

						// book info

								for(var j = 0;  j < size; j++){
									console.log("arr: " + cart_arr[j]);
									if(cart_arr[j] == row){
										console.log("arr: " + cart_arr[j] + "   isbn: " + row);
										elems[i].disabled = true;
									}
								}
							}
						</script>

				<?php
						echo " <td rowspan='2' align='left'>" .$row["title"]. "</br>By " .$row["author"]. "</br><b>Publisher:</b> " .$row["publisher"]. ",</br><b>ISBN:</b> " .$row["ISBN"]. "</t> <b>Price:</b> $" .$row["price"]. "</td></tr>";
						// reviews button
				
				
						//echo "<tr><td align='left'><button name='review' id='review' onClick=\" return review('". $row['ISBN'] . ", '" . $row['title'] . "'\");" . ">Reviews</button>";
				?>
						<tr><td align='left'><button name='review' id='review' onClick="return review( '<?=$row['ISBN']?>', '<?=$row['title']?>')">Reviews</button>
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
