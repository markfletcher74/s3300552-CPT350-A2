<?php
/*	s3300552 - CPT350SP2 - A2
	Mark Fletcher
	Grocery Optimiser
	
	CreateItemPrice.php	-	Creates a grocery item
	
*/

// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$price_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

	// Collection object
	$data = [
	  'item_id' => trim($_POST['item_id']),
	  'shop_id' => trim($_POST['shop_id']),
	  'price' => trim($_POST['price'])
	];

	// Initializes a new cURL session
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, API_AWSLambdaItemPriceURL);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
	
	// Execute cURL request with all previous settings
	$response = curl_exec($curl);
	// Close cURL session
	curl_close($curl);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Price Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add Price to Item</h2>
                    </div>
                    <p>Please fill this form and submit to add price to the list.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                            <label>Item</label>
							<select name="item_id">
								<?php
    // Prepare a select statement
    $sql = "SELECT brand,name,item_id FROM tbl_Items ORDER BY brand,name;";

	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0)
		{	
				/* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
				//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				while($row = mysqli_fetch_array($result)){				
					// Retrieve individual field value
					$item_id = $row["item_id"];
					$name = $row["brand"] . " " . $row["name"];
					echo '<option value="' . $item_id . '">' . $name . '</value>';
				}
		}
		else
		{
				echo "Something went wrong (" .$link->error.") Please try again later.";
				exit();
		}
	}
								
								?>
							</select>
							<label>Shop</label>
							<select name="shop_id">
								<?php
    // Prepare a select statement
    $sql = "SELECT shop_id,name FROM tbl_Shops ORDER BY name;";

	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0)
		{	
				/* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
				//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				while($row = mysqli_fetch_array($result)){				
					// Retrieve individual field value
					$shop_id = $row["shop_id"];
					$name = $row["name"];
					echo '<option value="' . $shop_id . '">' . $name . '</value>';
				}
		}
		else
		{
				echo "Something went wrong (" .$link->error.") Please try again later.";
				exit();
		}
	}
								?>
							</select>
                            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block"><?php echo $list_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="listitems.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>