<?php
/*	s3300552 - CPT350SP2 - A2
	Mark Fletcher
	Grocery Optimiser
	
	Index.php	-	Home Page
	
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grocery Optimiser</title>
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
		.img.resize	{
			max-width:50%;
			max-height:50%;
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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Grocery Optimiser</h2>
						<img class="resize" src="img/Grocery Optimiser Logo.png">
                    </div>
					<table class='table table-bordered table-striped'>
					<tr>
						<td><img class="resize" src="img/list.png" href="shops/listlists.php"></td><td><img class="resize" src="img/list.png" href="Items/addprices.php"></td>
					</tr>
					<tr>
						<td><img class="resize" src="img/shop.png" href="shops/listshops.php"></td><td><img src="img/groceries.png" href="items/listitems.php"></td>
					</tr>
					</table>
                </div>
            </div>        
        </div>
    </div>
	<center><small>img made by <a href="https://www.flaticon.com/authors/catkuro" title="catkuro">catkuro</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></small>
</body>
</html>