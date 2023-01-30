<!-- This is the Product List page -->
<?php
    include "dbh.php";
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    
    <title>Product List</title>
</head>
<body style="background-color: antiquewhite">
    <!-- This is the upper part of the website -->
    <div class="header">
        <h1 class="title">Product List</h1>
        
    </div>
    <hr class="line"/>
    <!-- This is the code for adding and delete every item -->
    <div class="container-fluid items">
        <a href="add-product.php"><button id="ADD" class="btn-success ">ADD</button></a>
        <form method="post">
            <button id="delete-product-btn" type="submit" name="delete">MASS DELETE</button>
            <div class="row">
                <?php
                    $sql = "SELECT * FROM itemadd";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='bord col-sm-2'>"; 
                            echo "<input type='checkbox' name='delete-checkbox[]' class='delete-checkbox' value=$row[Id] />" .
                                "<p>" . $row ['SKU'] . "</p>\n" .
                                "<p>" . $row ['Name'] . "</p>\n" .
                                "<p>" . $row ['Price'] . ".00\n" . "$</p>\n ";
                            if ($row ['Size'] > 0) {
                                echo "Size: " . $row ['Size'] . " MB";
                            } else if ($row ['Height'] > 0 || $row ['Width'] > 0 || $row ['Length'] > 0) {
                                echo "Dimensions: \n" . $row ['Height'] . "x" . $row ['Width'] . "x" . $row ['Length']; 
                            } else if ($row ['Weight'] > 0) {
                                echo "Weight: " . $row ['Weight'] . " KG";
                            }
                            echo "</div>";                        
                        }
                    }
                    
                ?>
            </div>
        </form>
        </div>
        <?php
        include "dbh.php";
        if(isset($_POST['delete'])){
            $all_id = $_POST['delete-checkbox'];
            if($all_id != NULL){
                $extract = implode(',',$all_id);
                $query = "DELETE FROM itemadd WHERE Id IN($extract)";
                $query_run = mysqli_query($conn, $query);
                header("Location: ../junior%20job%20task/");
                exit;
            } else{
                header("Location: ../junior%20job%20task/");
                exit;
            }
        }
        ?>
</body>
</html>