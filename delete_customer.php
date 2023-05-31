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

        $sql = "delete from `customers` where `cust_id` = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            header('location: customers.php');
        }else{
            die(mysqli_error($conn));
        }
    }
    
?>