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
$sql = "SELECT cust_id, name, number FROM customers";
$result = mysqli_query($conn, $sql);

// Output customer records in table format
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['cust_id'];
        echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["number"] . "</td>";
            echo "<td>
                    <a href='update_customers.php?updateid=".$id."'><img src='edit.png' alt='Edit'></a>
                    <a href='delete_customer.php?deleteid=".$id."'><img src='dele.png' alt='Delete'></a>
                  </td>";

        echo "</tr>";
    }
} else {
    echo "0 results";
}

// Close database connection
mysqli_close($conn);

?>
