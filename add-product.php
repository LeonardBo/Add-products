<!-- This is the Product Add page -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/add.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Product Add</title>
</head>
<body style="background-color: antiquewhite">
    <div class="header">
        <h1 class="title">Product Add</h1>
    </div>
    <a href='https://juniortestbosoileonard.000webhostapp.com/'><button class="cancel">Cancel</button></a>
    <!-- This is the form for add an item for the porduct page-->
    <form id="product_form" name="product_form" method="post">
        <button type="submit" class="save" name="submit">Save</button>
        <hr class="line"/> 
        <div class="form">
            <p class="exp">SKU</p>
            <input type="text" id="sku" class="input" name="sku" required oninvalid="this.setCustomValidity('Please, submit required data')" oninput="setCustomValidity('')"/>    
            <p class="exp">Name</p>
            <input type="text" id="name" class="input" name="name" required oninvalid="this.setCustomValidity('Please, submit required data')" oninput="setCustomValidity('')"/>
            <p class="exp">Price ($)</p>
            <input type="text" id="price" class="input" name="price" required step="any" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="setCustomValidity('')"/>
            <br>
            <p class="dropdown-title">Type Switcher</p>
            <select class="productType input" id="productType" value="productType" required onchange="update()"  >
                <option selected="selected" disabled></option>
                <option id="DVD" >DVD</option>
                <option id="Book">Book</option>
                <option id="Furniture">Furniture</option>
                
            </select>
            <div class="DVD" hidden="true">
                <p class="exp">Size (MB)</p>
                <input type="text" id="size" type="number" class="input" name="size" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="setCustomValidity('')"/>
                <p class="exp">Please provide size.</p>
            </div>
            <div hidden="true" class="Furniture">
                <p class="exp">Height (CM)</p>
                <input type="text" id="height" type="number" class="input" name="height" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="setCustomValidity('')"/>
                <p class="exp">Width (CM)</p>
                <input type="text" id="width" type="number" class="input" name="width" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="setCustomValidity('')"/>
                <p class="exp">Length (CM)</p>
                <input type="text" id="length" type="number" class="input" name="length" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="setCustomValidity('')"/>
                <p class="exp">Please provide dimensions.</p>
            </div>  
            <div hidden="true" class="Book">
                <p class="exp">Weight (KG)</p>
                <input type="text" id="weight" type="number" class="input" name="weight" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="setCustomValidity('')"/>
                <p class="exp">Please provide book weight.</p>
            </div>
        </div>
        <!-- This is the script for selecting options from dropdown -->
        <script type="text/javascript">
            function update() {
                var select = document.getElementById('productType');
                var value = select.options[select.selectedIndex].value;
                var dvd = document.getElementById("DVD").value;
                var furniture = document.getElementById("Furniture").value;
                var book = document.getElementById("Book").value;
                var cDVD = document.getElementsByClassName("DVD");
                var cFurniture = document.getElementsByClassName("Furniture")
                var cBook = document.getElementsByClassName("Book");
                var size = document.getElementById("size");
                var height = document.getElementById("height");
                var width = document.getElementById("width");
                var length = document.getElementById("length");
                var weight = document.getElementById("weight");
                if (value == dvd) {
                    cDVD[0].hidden = false;
                    cFurniture[0].hidden = true;
                    cBook[0].hidden = true;
                    size.required = true; 
                    height.required = false;
                    width.required = false;
                    length.required = false;
                    weight.required = false;
                    width.value = "";
                    length.value = "";
                    height.value = "";
                    weight.value = "";
                } else if (value == furniture) {
                    cFurniture[0].hidden = false;
                    cDVD[0].hidden = true;
                    cBook[0].hidden = true;
                    size.required = false;
                    height.required = true;
                    width.required = true;
                    length.required = true;
                    weight.required = false;
                    size.value = "";
                    weight.value = "";
                } else if (value == book) {
                    cBook[0].hidden = false;
                    cFurniture[0].hidden = true;
                    cDVD[0].hidden = true;
                    size.required = false;
                    height.required = false;
                    width.required = false;
                    length.required = false;
                    weight.required = true;
                    size.value = "";
                    width.value = "";
                    length.value = "";
                    height.value = "";
                }
            }
        </script>
        </form>
        <?php
        include "dbh.php";
        if (isset($_POST["submit"])) {  
            $sku = $_POST["sku"];
            $name = $_POST["name"];
            $price = $_POST["price"];
            $size = $_POST["size"];
            $height = $_POST["height"];
            $width = $_POST["width"];
            $length = $_POST["length"];
            $weight = $_POST["weight"];
            $qry = mysqli_query($conn ,"SELECT * FROM itemadd");
            while ($result = mysqli_fetch_array($qry)){
                if ($sku == $result["SKU"]){
                echo "<p><font color='red'>*SKU must be unique.</p>";
                exit;
                };
            }
            if (!is_numeric($price)){
                echo "<p><font color='red'>*Please, provide the data of indicated type</p>";
                exit;
            }
            if (empty($height) && empty($weight) && is_numeric($size)){
            $sql = "INSERT INTO `itemadd` (`SKU`, `Name`, `Price`, `Size`) VALUES ('$sku','$name','$price','$size')";
            }else if (empty($size) && empty($weight) && is_numeric($height) && is_numeric($width) && is_numeric($length)){
            $sql = "INSERT INTO `itemadd` (`SKU`, `Name`, `Price`, `Height`, `Width`, `Length`) VALUES ('$sku','$name','$price','$height', '$width', '$length')";
            }else if (empty($height) && empty($size) && is_numeric($weight)){
            $sql = "INSERT INTO `itemadd` (`SKU`, `Name`, `Price`, `Weight`) VALUES ('$sku','$name','$price','$weight')";
            } else {
                echo "<p><font color='red'>*Please, provide the data of indicated type</p>";
                exit;
            }
            mysqli_query($conn ,$sql);
            mysqli_close($conn);
            echo "<script>
                setTimeout(function()
                { 
                     window.location = 'http://localhost/junior%20job%20task/'; 
                });
                </script>"; 
            }
        ?>
    </body>
</html>