<!-- Welcome Screen provided by Dr Krish Narayanan via canvas -->
<!-- Figure 1: Welcome Screen by Alexander -->
<html>
    <head>
        <script>
		    function route(){
				var radio = document.getElementsByName("group1");
				var redirect;
				for(var i=0; i<radio.length; i++){
			    	if(radio[i].checked){
						redirect = radio[i].value;
			    	}
				}
				document.location=redirect;
				return false;
	    	j}
		</script>
    </head>
<title>Welcome to Best Book Buy Online Bookstore!</title>
<body>
	<table align="center" style="border:1px solid blue;">
	<tr><td><h2>Best Book Buy (3-B.com)</h2></td></tr>
	<tr><td><h4>Online Bookstore</h4></td></tr>
	<tr><td><form action="screen1.php" method="post">
		<input type="radio" name="group1" value="screen2.php" checked>Search Online<br/>
		<input type="radio" name="group1" value="customer_registration.php">New Customer<br/>
		<input type="radio" name="group1" value="user_login.php">Returning Customer<br/>
		<input type="radio" name="group1" value="admin_login.php">Administrator<br/>
		<input type="submit" name="submit" value="ENTER" onclick="return route();">
	</form></td></tr>
	</table>
</body>

</html>
