<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
<?php
//   include("./include/misc.inc");

//define('DB_SERVER', "s3300552-a2-dbinstance.c6k6qz9zx2ql.ap-southeast-2.rds.amazonaws.com");
define('DB_SERVER',"rds.aws.fletchernetwork.com");
define('DB_USERNAME', "s3300552");
define('DB_PASSWORD', "W0ts1mW0ts1m");
define('DB_DATABASE', "s3300552_A2_Database");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE)
          or die ("couldn't connect to Grocery Database");

$query = " SELECT * FROM grocery_upc ORDER BY brand,name;";

$result = mysqli_query($conn, $query);

echo '<table width="100%" border="1">';
echo '<tr>';
echo '<td>ID</td><td>UPC Code</td><td>Brand</td><td>Name</td>';
echo '</tr>';

  while($row = mysqli_fetch_assoc($result)) 
  {
	echo '<tr>';
	echo '<td>' . $row["id"] . '</td><td>' . $row["upc12"] . '</td><td>' . $row["name"]. '</td><td>' .$row["brand"] . "</td>";
	echo '</tr>';
  }

echo '</table>';
  mysqli_close($conn);


?>
</body>
</html>

