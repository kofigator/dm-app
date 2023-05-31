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

    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "delete from `items` where `item_id` = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            header('location: items.php');
        }else{
            die(mysqli_error($conn));
        }
    }
    
?>