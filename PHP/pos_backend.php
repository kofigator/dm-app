<?php
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "debt");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user has entered anything in the search box
if (isset($_GET['search']) && !empty($_GET['search'])) {
    // Sanitize the user input to prevent SQL injection
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    
    // Construct a query to retrieve items from the database based on the user's search
    $query = "SELECT * FROM items WHERE name LIKE '%$search%'";
    
    // Execute the query
    $result = mysqli_query($conn, $query);
    
    // Check if the query returned any results
    if (mysqli_num_rows($result) > 0) {
        // Loop through the results and output them in <tr> tags in the <tbody>
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td><input type='number' name='quantity[]' value='1'></td>";
            echo "</tr>";
        }
    } else {
        // Output a message if no results were found
        echo "<tr><td colspan='3'>No items found.</td></tr>";
    }
}

// Close the database connection
mysqli_close($conn);
?>
