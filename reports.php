<?php
session_start();
if (!isset($_SESSION["user"])) header("Location: index.php");
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}
require_once('classes/Inventory.php');
$Inventory = new Inventory();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />

    <style>
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        header>h1 {
            text-align: center !important;
        }

        .dashboard-item {
            border-radius: 15px;
            text-align: center;
            font-size: 18px;
            color: #fff;
        }
       

        .back {
            cursor: pointer;
        }
    </style>
</head>

<body class="fluid-container">

    <header style="position: relative !important; width: 100% !important; height: 60px !important; display: flex; justify-content: center; align-items: center">
        <span style="flex-grow: 1" class="bi bi-arrow-left back" style="color: #fff !important; font-size: 26px !important"></span>
        <h1 style="flex-grow: 8">Reports</h1>
        <?php require_once('inc/header.php') ?>
    </header>


    <div style="position: relative !important; margin-top: 0px !important">
        <div class="row">
            <a href="customers_reports.php" class="col-md-4 m-3 bg-success  dashboard-item">
                <div style="padding: 35px">
                    Customers
                </div>
            </a>

            <a href="inventory_reports.php" class="col-md-4 m-3 bg-success  dashboard-item">
                <div style="padding: 35px">
                    Inventory
                </div>
            </a>
           
            <a href="pos_report.php" class="col-md-4 m-3 bg-success  dashboard-item">
                <div style="padding: 35px">
                    Sales
                </div>
            </a>
        </div>
           
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script>
        $(document).ready(function() {

            $(".back").click(function() {
                window.location.href = "dashboard.php";
            });
        })
    </script>
</body>

</html>