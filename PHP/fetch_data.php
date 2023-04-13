<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "debt";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$input = $_POST['item'];

$sql = "SELECT * FROM items WHERE name LIKE '%$input%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo '<select>';
	while($row = $result->fetch_assoc()) {
		echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
	}
	echo '</select>';
} else {
	echo 'No items found';
}

$conn->close();
?>
