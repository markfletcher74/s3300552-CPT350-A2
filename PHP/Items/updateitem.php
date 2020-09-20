<?php
/*	s3300552 - CPT350SP2 - A2
	Mark Fletcher
	Grocery Optimiser
	
	UpdateItem.php	-	Updates a grocery item
	
*/

// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$name = $brand = "";
$name_err = $brand_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["item_id"]) && !empty($_POST["item_id"])){
    // Get hidden input value
    $item_id = $_POST["item_id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate brand brand
    $input_brand = trim($_POST["brand"]);
    if(empty($input_brand)){
        $brand_err = "Please enter a brand.";
    } elseif(!filter_var($input_brand, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $brand_err = "Please enter a valid brand.";
    } else{
        $brand = $input_brand;
    }
    
    // Check input errors before inserting in database
	if(empty($name_err) && empty($brand_err)){
	// Prepare an update statement
	$sql = "UPDATE tbl_Items SET name = '" . $name . "', brand = '" .$brand . "' WHERE item_id = " . $item_id . ";";

	if ($link->query($sql) === TRUE) {
			header("location: listitems.php");
			exit();
	} else{
			echo "Something went wrong (" .$link->error.") Please try again later.";
	}

	/*
    if(empty($name_err) && empty($brand_err)){
        // Prepare an update statement
        $sql = "UPDATE tbl_Items SET name=?, brand=? WHERE item_id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_brand, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_brand = $brand;
            $param_id = $item_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["item_id"]) && !empty(trim($_GET["item_id"]))){
        // Get URL parameter
        $item_id =  trim($_GET["item_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM tbl_Items WHERE item_id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $item_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["name"];
                    $brand = $row["brand"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($brand_err)) ? 'has-error' : ''; ?>">
                            <label>brand</label>
                            <input type="text" name="brand" class="form-control" value="<?php echo $brand; ?>">
                            <span class="help-block"><?php echo $brand_err;?></span>
                        </div>
                        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="listitems.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>