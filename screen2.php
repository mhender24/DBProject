<!-- Screen 2 Screen provided by Dr Krish Narayanan via canvas -->
<!-- Figure 2: Search Screen by Alexander -->
<html>
<head>
	<title>SEARCH - 3-B.com</title>
	<script>
	function enableSearch(){
		var text = document.getElementById("searchfor").value;
		if(text.length > 0)
			document.getElementById("search").disabled = false;
		return false;
	}
	</script>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td>Search for: </td>
			<form action="screen3.php" method="get">
				<td><input type = "text" id="searchfor" name = "searchfor" onblur="enableSearch()"/></td>
				<td><input type="submit" id="search" value="Search" disabled/></td>
		</tr>
		<tr>
			<td>Search In: </td>
				<td>
					<select name="searchon[]" multiple="multiple">
						<option value="anywhere" selected='selected'>Keyword anywhere</option>
						<option value="title">Title</option>
						<option value="author">Author</option>
						<option value="publisher">Publisher</option>
						<option value="isbn">ISBN</option>
					</select>
				</td>
				<td><a href="shopping_cart.php"><input type="button" name="manage" value="Manage Shopping Cart" /></a></td>
		</tr>
		<tr>
			<td>Category: </td>
				<td><select name="category">
						<option value='all' selected='selected'>All Categories</option>
						<option value='fantasy'>Fantasy</option>
						<option value='adventure'>Adventure</option>
						<option value='fiction'>Fiction</option>
						<option value='horror'>Horror</option>
						</select></td>
				</form>
	<form action="screen1.php" method="post">
				<td><input type="submit" name="exit" value="EXIT 3-B.com" /></td>
			</form>
		</tr>
	</table>
</body>
</html>
