
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Page</title>
    <link rel="stylesheet" href="../CSS/newStyle.css">
</head>
<body>
    <nav>
        <ul>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropbtn"><img src="../IMAGES/drop.jpg" alt="" width="30px" height="30px"></a>
              <div class="dropdown-content">
                <a href="../HTML/add_customer.html">Add New Customer</a>
              </div>
            </li>
            <li id="customer_header"><h1>CUSTOMERS</h1></li>
        </ul>
    </nav>

    <div>
        <table>
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Phone No.</th>
                </tr>   
            </thead>
            <tbody id="tableBody">
            <?php 
                include 'retrieve_customers.php'; 
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
