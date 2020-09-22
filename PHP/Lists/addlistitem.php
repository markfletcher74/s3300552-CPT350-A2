<?php
/*	s3300552 - CPT350SP2 - A2
	Mark Fletcher
	Grocery Optimiser
	
	AddListItem.php	-	Adds an item to the list
	
*/

// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$list = "";
$list_err = "";

// Validate passed list ID
if(empty($_GET["list_id"])) {
	$list_err = "Please choose a list.";
} else{
	$list = trim($_GET["list_id"]);
}
     
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	// Clear any previous non-positive
	
	$list_err = "";
	
    // Validate name
    $input_list = trim($_POST["list_id"]);
	
    if(empty($input_list)){
        $list_err = "Please choose a list.";
    } else{
        $list = $input_list;
    }
    
    // Check input errors before inserting in database
    if(empty($list_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tbl_ListItems (list_id,item_id) VALUES (" . $list . "," . trim($_POST["item_id"]) . ")";
 
		if ($link->query($sql) === TRUE) {
	            header("location: listlists.php");
                exit();
		} else{
                echo "Something went wrong (" .$link->error.") Please try again later.";
		}
  
		/*
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            
            // Attempt to execute the prepared statement
			
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
		*/
		
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Add Item to List</h2>
                    </div>
                    <p>Please fill this form and submit to add item to the list.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($list_err)) ? 'has-error' : ''; ?>">
                            <label>Item</label>
							<select name="item_id">
								<?php
    // Prepare a select statement
    $sql = "SELECT brand,name,item_id FROM tbl_Items WHERE item_id NOT IN (SELECT item_id FROM tbl_ListItems WHERE list_id = " . trim($_GET["list_id"]) . ") ORDER BY brand,name;";

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
                            <input type="text" name="qty" class="form-control" value="<?php echo $qty; ?>">
                            <span class="help-block"><?php echo $list_err;?></span>
                        </div>
						<input type="hidden" name="list_id" value="<?php echo $list ?>">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="listlists.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>