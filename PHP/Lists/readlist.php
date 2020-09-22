<?php
/*	s3300552 - CPT350SP2 - A2
	Mark Fletcher
	Grocery Optimiser
	
	ReadList.php	-	Displays a list
	
*/

// Check existence of id parameter before processing further
if(isset($_GET["list_id"]) && !empty(trim($_GET["list_id"])))
{
    // Include config file
    require_once "../config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM tbl_List WHERE list_id = '" . trim($_GET["list_id"]) . "';";


	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0)
		{	
				/* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				
				// Retrieve individual field value
				$name = $row["name"];
		}
		else
		{
				echo "Something went wrong (" .$link->error.") Please try again later.";
				exit();
		}
	}
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
                        <h1>View list</h1>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <p><a href="listlists.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>