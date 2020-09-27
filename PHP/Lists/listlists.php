<?php
/*      s3300552 - CPT350SP2 - A2
        Mark Fletcher
        Grocery Optimiser

        Listlists.php   -       List all lists

*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Lists</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>

<?php
// Include config file

require_once "../config.php";

if(!empty($_GET["list_id"]))
{
    // Get hidden input value
    $list_id = $_GET["list_id"];

        // Prepare a select statement
    $sql = "SELECT a.name AS List,b.item_id,c.brand,c.name FROM tbl_Lists a JOIN tbl_ListItems b ON a.list_id=b.list_id JOIN tbl_Items c ON b.item_id=c.item_id WHERE a.list_id = " . $list_id . ";";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, API_AWSLambdaBestPriceURL);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);

        // Attempt select query execution
        if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
								echo "<tr>";
								echo "<th>Brand</th>";
								echo "<th>Name</th>";
								echo "<th>Price</th>";
								echo "<th>Shop</th>";
								echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
									echo "<tr>";
									echo "<td>" . $row['brand'] . "</td>";
									echo "<td>" . $row['name'] . "</td>";
									//  Call Lambda function to get information about the best place and its price
									$json = ['item_id' => $row['item_id']];
									curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($json));
									$lambdaresult = curl_exec($curl);
									echo $lambdaresult;
									echo "<td>" . $lambdaresult[1] . "</td>";
									echo "<td>" . $lambdaresult[0] . "</td>";
									echo "</tr>";
                                }
                                echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                }
        }
        else
        {
                echo "result is $result";
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }

        // Close connection
        mysqli_close($link);

}
else
{
        // Display the lists
?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Shopping Lists</h2>
                        <a href="createlist.php" class="btn btn-success pull-right">Add New list</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM tbl_Lists ORDER BY name";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>list Name</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
									echo "<td><a href=\"" . htmlspecialchars(basename($_SERVER['SCRIPT_NAME'])) . "?list_id=". $row['list_id'] ."\">" . $row['name'] . "</a></td>";
									echo "<td>";
									echo "<a href='readlist.php?list_id=". $row['list_id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
									echo "<a href='updatelist.php?list_id=". $row['list_id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
									echo "<a href='addlistitem.php?list_id=". $row['list_id'] ."' title='Add Item to List' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
									echo "<a href='deletelist.php?list_id=". $row['list_id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
									echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
</body>
</html>
