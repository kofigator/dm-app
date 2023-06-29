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

        .row {
            display: flex;
            justify-content: center;
            padding: 100px 0px;
        }
    </style>
</head>

<body class="fluid-container">

    <header style="position: relative !important; width: 100% !important; height: 60px !important; display: flex; justify-content: center; align-items: center">
        <h1 style="flex-grow: 8">Dashboard</h1>
        <?php require_once('inc/header.php') ?>
    </header>

    <div style="position: relative !important; margin-top: 0px !important">
        <div class="row">
            <a href="customers.php" class="col-md-4 m-3 bg-success  dashboard-item">
                <div style="padding: 35px">
                    Customers
                </div>
            </a>
            <a href="items.php" class="col-md-4 m-3 bg-success dashboard-item">
                <div style="padding: 35px">
                    Inventory
                </div>
            </a>
            <a href="pos.php" class="col-md-4 m-3 bg-success dashboard-item">
                <div style="padding: 35px">
                    POS
                </div>
            </a>
            <a href="reports.php" class="col-md-4 m-3 bg-success dashboard-item">
                <div style="padding: 35px">
                    Reports
                </div>
            </a>
            <a href="debts.php" class="col-md-4 m-3 bg-success dashboard-item">
                <div style="padding: 35px">
                    Debts
                </div>
            </a>
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