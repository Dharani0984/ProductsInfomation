<?php
include_once('dbconnect.php');
// Assuming you have a MySQL database connection already established

// Get the product name and price data
$productNames = $_POST['name'];
$productPrices = $_POST['price'];

// Get the offer price and tax data
$offerPrices = $_POST['offer_price'];
$taxValues = $_POST['tax'];

// Insert product name and price data
for ($i = 0; $i < count($productNames); $i++) {
    $productName = $productNames[$i];
    $productPrice = $productPrices[$i];

    // Perform any necessary validations on the data

    // Insert data into the product table
    $query = "INSERT INTO products (name, price) VALUES ('$productName', '$productPrice')";
    // Execute the query
    // ...

    // Handle any errors or success messages
    // ...
}

// Insert offer price and tax data
for ($i = 0; $i < count($offerPrices); $i++) {
    $offerPrice = $offerPrices[$i];
    $tax = $taxValues[$i];

    // Perform any necessary validations on the data

    // Insert data into the offer price table
    $query = "INSERT INTO offer_prices (offer_price, tax, subtoal, total) VALUES ('$offerPrice', '$tax')";
    // Execute the query
    // ...

    // Handle any errors or success messages
    // ...
}

// Redirect or display a success message
// ...
?>
