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

$product_id = "";
$name = "";
$description = "";
$price = "";
$stock = "";
$category_id = "";

$errorMessage = "";
$successMessage = "";

// Check if product ID is set in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch the product's current data
    $sql = "SELECT * FROM products WHERE product_id='$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        $stock = $row['stock'];
        $category_id = $row['category_id'];
    } else {
        $errorMessage = "Product not found.";
    }
}

// Check if the form has been submitted to update the data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $category_id = $_POST["category_id"];

    // Validate form data
    do {
        if (empty($name) || empty($description) || empty($price) || empty($stock) || empty($category_id)) {
            $errorMessage = "All fields are required.";
            break;
        }

        // Update product information
        $sql = "UPDATE products SET name='$name', description='$description', price='$price', stock='$stock', category_id='$category_id' WHERE product_id='$product_id'";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Error updating record: " . $conn->error;
            break;
        }

        $successMessage = "Product updated successfully.";
        header("location: /inventory/index.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Edit Product</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                  </div>";
        }
        if (!empty($successMessage)) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                  </div>";
        }
        ?>

        <form method="post">
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
                <label class="col-sm-3 col-form-label">Category ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="category_id" value="<?php echo $category_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/inventory/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>