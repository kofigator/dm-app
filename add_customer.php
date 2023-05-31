<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    
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
        input[type="password"] {
          display: block;
          margin-bottom: 10px;
          padding: 10px;
          width: 92%;
          border: 1px solid #ccc;
          border-radius: 3px;
        }
        select {
            padding: 20px 0px;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: larger;
            text-align: center;
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
    <form id="addCustomer-form" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="gender">Gender</label>
        <select name="gender" id="">
            <option value="default"></option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <input type="submit" value="Add Customer">
    </form>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {

      $("#addCustomer-form").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "api/add_customer",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
        }).done(function(data) {
          console.log(data);
          if (data.success) {
            window.location.href = "customers.php";
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