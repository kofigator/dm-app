<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="../CSS/main_style.css">-->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <title>Login Page</title>
    <style>
        .body>form {
            height: 100% !important;
            width: 100% !important;
        }

        form {
            max-width: 500px;
        }

        #tableBody td {
            padding-right: 40px;
            padding-bottom: 20px;
        }

        .act_btn td {
            padding: 20px;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a,
        .dropbtn {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover,
        .dropdown:hover .dropbtn {
            background-color: rgb(236, 195, 195);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        #customer_header {
            margin: 5px 10px;
            color: #fff;

        }
    </style>
</head>

<body class="fluid-container">
    <nav>
        <ul>
            <li class="dropdown">
                <a href="add_customer.php" class="dropbtn"><img src="add.jpg" alt="" width="35px" height="35px"></a>

            </li>
            <li id="customer_header">
                <h1>CUSTOMERS</h1>
            </li>
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

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#Login-Form").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "api/login",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    if (data.success) {
                        window.location.href = "dashboard.php";
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