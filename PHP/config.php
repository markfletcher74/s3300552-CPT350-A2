<?php
/* CPT350 - Cloud Computing
   s3300552 - Mark Fletcher
   Grocery Optimiser
*/

define('DB_SERVER',"rds.aws.fletchernetwork.com");
define('DB_USERNAME', "s3300552");
define('DB_PASSWORD', "W0ts1mW0ts1m");
define('DB_DATABASE', "s3300552_A2_Database");

define('API_AWSLambdaItemPriceURL', "https://3seplhcsg0.execute-api.ap-southeast-2.amazonaws.com/Development/itemprice");
define('API_AWSLambdaBestPriceURL', "https://3seplhcsg0.execute-api.ap-southeast-2.amazonaws.com/Development/bestprice");

/* Try connecting to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
