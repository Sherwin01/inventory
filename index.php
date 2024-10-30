<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AsianBudols</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h2>List of Products</h2>
        <a class="btn btn-outline-primary" href="/AsianBudols/create.php" role="Button">Add Product</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category_id</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "asianbudols";
                
                // Create connection
                // hello
                $conn = new mysqli($servername, $username, $password, $database);
                
                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                echo "Connected Successfully.";

                // read all row from database table
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }
                
                //read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                <tr>
                    <td>$row[product_id]</td>
                    <td>$row[name]</td>
                    <td>$row[description]</td>
                    <td>$row[price]</td>
                    <td>$row[stock]</td>
                    <td>$row[category_id]</td> 
                    <td>
                        <a class='btn btn-outline-warning' href='/AsianBudols/edit.php?id=$row[product_id]' role='Button'>Edit</a>
                        <a class='btn btn-outline-danger' href='/AsianBudols/delete.php?id=$row[product_id]' role='Button'>Delete</a>
                    </td>
                </tr>
                    ";
                }

                ?>
            </tbody>
        </table>
    </div>
</body>
</html>