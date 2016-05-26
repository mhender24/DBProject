<!-- Book Reviews Screen provided by Dr Krish Narayanan via canvas -->
<!-- screen 4: Book Reviews by Prithviraj Narahari, php coding: Alexander Martens-->
<!DOCTYPE html>
<html>
<head>
<title>Book Reviews - 3-B.com</title>
<style>
.field_set
{
	border-style: inset;
	border-width:4px;
}
</style>
</head>
<body>

	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="center">
				<h5> Reviews For:</h5>
			</td>
			<td align="left">
				<!-- php here for getting book title -->
				<h5> <?php echo $_GET["title"]; ?> </h5>
			</td>
		</tr>

		<tr>
			<td colspan="2">
			<div id="bookdetails" style="overflow:scroll;height:200px;width:300px;border:1px solid black;">
			<table>

				<?php
				$isbn = $_GET["isbn"];
				$sql = "SELECT review_txt FROM reviews":
				$result = $conn->query($sql);
				while($row = $result->fetch_accoc()){
					echo <tr><p> $row["review_txt"] </p></tr>;
				}


			 ?>

			</table>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<form action="screen2.php" method="post">
					<input type="submit" value="Done">
				</form>
			</td>
		</tr>
	</table>

</body>

</html>
