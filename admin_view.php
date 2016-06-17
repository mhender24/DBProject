<?php
	$cust_count_sql = "	SELECT count(*)
						FROM users";
	$book_count_sql = " SELECT genre, count(*)
						FROM book
						GROUP BY genre
						ORDER BY count(*) DESC";
	$month_sales_sql ="SELECT extract(month from date) as date ,round(avg(total), 2) as avg
						FROM orders
						WHERE extract(year from curdate()) = extract(year from date)
						GROUP BY extract(month from date)";
	$book_review_sql =" SELECT b.title, count(r.review_number)
						FROM book as b, reviews as r
						WHERE b.isbn = r.isbn
						GROUP BY b.title";

	include 'common.php';
	db_open();

	$cust_count_result =  mysqli_query($link, $cust_count_sql);
	$cust_row = mysqli_fetch_assoc($cust_count_result);

	$month_sales_result = mysqli_query($link, $month_sales_sql);

?>



<html>
    <head><title>Administrator Reports</title></head>
    <body>
        <h1>Reports</h1>
	<p>Total number of registered customers:  <?=$cust_row['count(*)']?></p>

	<table border="1">
	    <tr>
		<th colspan="2">Book Inventory Report</th>
	    </tr>
	    <tr>
		<th>Genre</th>
		<th>Number of Books</th>
	    </tr>
	    <?php
	    if ($book_count_result = mysqli_query($link, $book_count_sql)) {
			while($row = mysqli_fetch_assoc($book_count_result) ){

				echo "<tr><td>";
				echo $row["genre"];
				echo "</td><td>";
				echo $row['count(*)'];
				echo "</td></tr>";
			}
		}
		?>
        </table>

	<br/><br/>
	<table border = "1">
	    <tr>
		<th colspan="2">Sales by Month</th>
	    </tr>
	    <tr>

		<th>Month</th>
		<th>Income</th>
	    </tr>
			<?php
				if($month_sales_result = mysqli_query($link, $month_sales_sql)){
					while ($row = mysqli_fetch_assoc($month_sales_result) ){
						echo "<tr><td>";
						if($row["date"] == "1"){
							echo 'January';
						} else if ($row["date"] == "2"){
							echo 'Feburary';
							echo 'March';
							echo 'April';
							echo 'May';
						} else if($row["date"] == "6"){
							echo 'June';
						} else if($row["date"] == "7"){
							echo 'July';
						} else if($row["date"] == "8"){
							echo 'August';
						} else if($row["date"] == "9"){
							echo 'September';
						} else if($row["date"] == "10"){
							echo 'October';
						} else if($row["date"] == "11"){
							echo 'November';
						} else if($row["date"] == "12"){
							echo 'December';
						}
						//echo $row['date'];
						echo "</td><td>$";
						echo $row['avg'];
						echo "</td></tr>";
					}
				}


			?>
	</table>

	<br/><br/>
	<table border="1">
	    <tr>
		<th colspan="2">Book Reviews</th>
	    </tr>
	    <tr>
		<th>Book Title</th>
		<th>Number of Reviews</th>
	    </tr>
	    <?php
	    if ($book_review_result = mysqli_query($link, $book_review_sql)) {
			while($row = mysqli_fetch_assoc($book_review_result) ){
				echo "<tr><td>";
				echo $row["title"];
				echo "</td><td>";
				echo $row['count(r.review_number)'];
				echo "</td></tr>";
			}
		}
		?>
	</table>

	<br/><br/>
	<input type="button" name="exit" onclick="location.href='screen1.php';" value="EXIT 3-B.com"/>
    </body>
</html>




    <body>
</html>
