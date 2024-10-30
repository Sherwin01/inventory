<?php


                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "asianbudols";
                
                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);
                
                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                echo "Connected Successfully.";

$product_id = "";
$name = "";
$description = "";
$price = "";
$stock = "";
$category_id = "";

$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $product_id = $_POST["product_id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $category_id = $_POST["category_id"];

    do {
        if  ( empty($product_id) || empty($name) || empty($description) || empty($price) || empty($stock) || empty($category_id) ) {
            $errorMessage = "All the fields are required." ;
            break;
        }

        //add new product to database

        $sql = "INSERT INTO products (product_id, name, description, price, stock, category_id) " . 
                "VALUES ('$product_id', '$name', '$description', '$price', '$stock', '$category_id')";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        $product_id = "";
        $name = "";
        $description = "";
        $price = "";
        $stock = "";
        $category_id = "";

        $successMessage = "Product Successfully added.";

        header("location: /AsianBudols/index.php");
        exit;


    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AsianBudols</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Add Product<h2>

        <?php
        if ( !empty($errorMessage) ) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }

        ?>

            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Product_id</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="product_id" value="<?php echo $product_id; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Stock</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="stock" value="<?php echo $stock; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Category_id</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="category_id" value="<?php echo $category_id; ?>">
                    </div>
                </div>


                <?php
                if ( !empty($successMessage) ) {
                    echo "
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div>
                    </div>
                    ";
                }
                ?>

                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/AsianBudols/index.php" role="button">Cancel</a>
                    </div>
                </div>
            </form>

    </div>
</body>
</html>