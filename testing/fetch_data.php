<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "debt";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from database based on user input
$search_term = $_GET['search_term'];
$query = "SELECT item_name, unit_price FROM items WHERE item_name LIKE '%{$search_term}%' LIMIT 10";
$result = mysqli_query($conn, $query);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
