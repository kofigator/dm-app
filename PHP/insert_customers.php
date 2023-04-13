<?php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "debt";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the form data
$name = mysqli_real_escape_string($conn, $_POST['name']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);

// Determine gender initial based on selected option
$gender = $_POST["gender"];
if ($gender == "Male") {
    $gender_initial = "M";
} elseif ($gender == "Female") {
    $gender_initial = "F";
} else {
    die("Please fill in all required fields.");
    mysqli_close($conn);
}

// Validate the form data
if (empty($name) || empty($phone) || empty($gender)) {
    echo "Please fill in all required fields.";
} else {

    // Insert the data into the database
    $sql = "INSERT INTO customers (name, number, gender, address)
            VALUES ('$name', '$phone', '$gender_initial', '$address')";

    if (mysqli_query($conn, $sql)) {
        echo "Record created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);

?>
