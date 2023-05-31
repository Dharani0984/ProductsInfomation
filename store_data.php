<?php


$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "products_info"; 

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(!empty($_POST['products'])){
    // Retrieve products data from AJAX request
    $products = $_POST['products'];

// Insert product information into 'products' table
    foreach ($products as $product) {
        $productName = $conn->real_escape_string($product['productName']);
        $price = $product['price'];

        $sql = "INSERT INTO products (product_name, price) VALUES ('$productName', '$price')";
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

// Insert offer information into 'offers' table
    foreach ($products as $product) {
        $offerPrice = $product['offerPrice'];
        $tax = $product['tax'];
        $subTotal = $product['subTotal'];
        $total = $subTotal; // You can modify this based on your logic

        $sql = "INSERT INTO offer_prices (offer_price, tax, subTotal, total) VALUES ('$offerPrice', '$tax', '$subTotal', '$total')";
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    echo "Product information and offer details stored successfully.";

// Close the connection
    $conn->close();
}else{
    echo "not data available";
}

?>
