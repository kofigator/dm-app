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

// Fetch customer records
$sql = "SELECT name, number FROM customers";
$result = mysqli_query($conn, $sql);

// Output customer records in table format
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["number"] . "</td>";
        echo "<td><button id='editBtn'>edit</button></td>";
        echo "<td><button id='deleteBtn'>del</button></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

// Close database connection
mysqli_close($conn);

?>
