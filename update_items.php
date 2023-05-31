<?php
 // Connect to database
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "debt";

 $conn = mysqli_connect($servername, $username, $password, $dbname);

 $id = $_GET['updateid'];

 $sql = "select * from items where item_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

    $itemName = $row['item_name'];
    $description = $row['description'];
    $unitPrice = $row['unit_price'];
    $quantity = $row['quantity'];

 $id = mysqli_real_escape_string($conn, $id);
 
 if (isset($_POST['submit'])) {
     // Rest of the code...
 
    $itemName = $_POST['item_name'];
    $description = $_POST['description'];
    $unitPrice = $_POST['unit_price'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE `items` SET item_name = '$itemName', description = '$description', unit_price = '$unitPrice', quantity = '$quantity' WHERE item_id = $id";


    $result = mysqli_query($conn, $sql);
    if($result){
        echo "updated successfully";
        header('location: items.php');
    }else{
        die(mysqli_error($conn));
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>

    <style>
        body {
          font-family: Arial, sans-serif;
        }
        form {
          border: 1px solid #ccc;
          padding: 30px;
          padding-right: 40px;
          margin: 50px auto;
          max-width: 400px;
          display: flex;
          flex-direction: column;
        }
        h1{
          display: flex;
          justify-content: center;
        }
        h2{
          display: flex;
          justify-content: center;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="password"] {
          display: block;
          margin-bottom: 10px;
          padding: 10px;
          width: 92%;
          border: 1px solid #ccc;
          border-radius: 3px;
        }
        
        input[type="submit"] {
          background-color: #4CAF50;
          border: none;
          color: white;
          padding: 15px 20px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          border-radius: 5px;
          cursor: pointer;
          margin: 30px 60px;
        }
        input[type="submit"]:hover {
          background-color: #3e8e41;
        }
        label {
          display: block;
          margin-bottom: 5px;
          font-weight: bold;
        }
      </style>
</head>
<body>
    <h1>Add An Item</h1>
    <form id="addItem-form" method="post">
        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" value="<?php echo $itemName; ?>" required>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo $description; ?>" required>

        <label for="unit_price">Unit Price:</label>
        <input type="text" id="unit_price" name="unit_price" value="<?php echo $unitPrice; ?>" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $quantity; ?>" required>

        <input type="submit" value="Update Item" name="submit">
    </form>

</body>
</html>