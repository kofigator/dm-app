<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/newStyle.css">
    <title>Items Page</title>
</head>

<body>
    <nav>
        <ul>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropbtn"><img src="../IMAGES/drop.jpg" alt="" width="30px" height="30px"></a>
              <div class="dropdown-content">
                <a href="../HTML/add_item.html">Add New Items</a>
              </div>
            </li>
            <li id="item_header">ITEMS</li>
        </ul>
    </nav>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Unit Price</th> 
                </tr>
            </thead>
            <tbody id="tableBody">
              <?php 
                include 'retrieve_items.php'; 
              ?>
            </tbody>
        </table>
    </div>
</body>
</html>