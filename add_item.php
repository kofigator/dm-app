<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>

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
        <input type="text" id="item_name" name="item_name" required>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>

        <label for="unit_price">Unit Price:</label>
        <input type="text" id="unit_price" name="unit_price" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>

        <input type="submit" value="Add Item">
    </form>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {

      $("#addItem-form").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "api/add_item",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
        }).done(function(data) {
          console.log(data);
          if (data.success) {
            window.location.href = "items.php";
          }
          alert(data.message);
          return;
        }).fail(function(error) {
          console.log(error);
        })
      });

    });
  </script>
</body>
</html>