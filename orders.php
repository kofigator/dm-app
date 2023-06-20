<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />

    <style>
        /* Your CSS styles here */
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body class="fluid-container">
<header style="position: relative !important; width: 100% !important; height: 60px !important; display: flex; justify-content: center; align-items: center">
        <span style="flex-grow: 1" class="bi bi-arrow-left back" style="color: #fff !important; font-size: 26px !important"></span>
        <h1 style="flex-grow: 8">Order an Item</h1>
        <?php require_once('inc/header.php') ?>
    </header>

    <div class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form id="add-item-form" method="post">
                        
            <div class="form-outline mb-4">
                <input type="text" id="item-name" name="item-name" class="form-control" />
                <label class="form-label" for="item-name">Item Name</label>
            </div>

            <div class="form-outline mb-4">
                <textarea id="description" name="description" class="form-control"></textarea>
                <label class="form-label" for="description">Description</label>
            </div>

            <div class="form-outline mb-4">
                <input type="number" id="quantity" name="quantity" class="form-control" />
                <label class="form-label" for="quantity">Quantity</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="budgetted-price" name="budgetted-price" class="form-control" />
                <label class="form-label" for="budgetted-price">Budgetted Price</label>
            </div>

            <div class="form-outline mb-4">
                <input type="email" id="email-addr" name="email-addr" class="form-control" />
                <label class="form-label" for="email-addr">Email Address</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="phone-number" name="phone-number" class="form-control" />
                <label class="form-label" for="phone-number">Phone Number</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="address" name="address" class="form-control" />
                <label class="form-label" for="address">Address [Town]</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <!-- Your custom scripts here -->
    <script>
        $(document).ready(function() {
            $(".back").click(function() {
                window.location.href = "dashboard.php";
        })
        });
    </script>
</body>

</html>
