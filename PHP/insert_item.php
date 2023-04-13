<?php

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "debt";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Validate form data
  $item_name = validate_input($_POST['item_name']);
  $description = validate_input($_POST['description']);
  $unit_price = validate_input($_POST['unit_price']);
  $quantity = validate_input($_POST['quantity']);

  // Check for any errors
  $errors = array();
  if (empty($item_name)) {
    $errors[] = 'Item name is required';
  }
  if (empty($description)) {
    $errors[] = 'Description is required';
  }
  if (!is_numeric($unit_price) || $unit_price <= 0) {
    $errors[] = 'Unit price must be a positive number';
  }
  if (!is_numeric($quantity) || $quantity <= 0) {
    $errors[] = 'Quantity must be a positive number';
  }

  // If there are no errors, insert data into the database
  if (empty($errors)) {
    // TODO: Insert data into the database using SQL INSERT statement

    $sql = "INSERT INTO items (item_name, description, unit_price, quantity) 
    VALUES ('$item_name', '$description', '$unit_price', '$quantity')";

    $result = mysqli_query($conn, $sql);
    echo "Data inserted successfully!";
  } else {
    // Display error messages
    foreach ($errors as $error) {
      echo "<p>Error: $error</p>";
    }
  }
}

// Function to validate form input
function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
