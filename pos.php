<?php
session_start();
if (!isset($_SESSION["user"])) header("Location: index.php");
require_once('classes/Inventory.php');
$Inventory = new Inventory();
?>
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
    <title>Items Page</title>

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

        #item_header {
            margin: 15px 50px;
            color: #fff;

        }
        
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
        }
        .back {
            cursor: pointer;
        }

        .add-new-element {
            cursor:pointer;
            position:absolute; 
            right: 15px; 
            font-size: 50px; 
            border-radius: 50px; 
            color: green;
            bottom: 0px;
        }
    </style>
</head>

<body class="fluid-container">

    <header style="position: relative !important; width: 100% !important; height: 60px !important; display: flex; justify-content: center; align-items: center">
        <span style="flex-grow: 1" class="bi bi-arrow-left back" style="color: #fff !important; font-size: 26px !important"></span>
        <h1 style="flex-grow: 8">Point Of Service</h1>
        <span style="flex-grow: 1" class="bi bi-clock-history" title="Sales history"></span>
    </header>

    <input type="text" class="form-control-lg" style="width: 100%; border: none !important; border-radius: 0px !important" name="search" placeholder="Search to add item">
        
    <div style="position: relative !important; margin-top: 0px !important;">
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>SN</th>
                    <th>Item</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total (GHc)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>jgfhgdfhghkjlkjghfgh</td>
                    <td class="unit-price">9.00</td>
                    <td><input type="number" id="" class="form-control item-qty" style="width: 80px" pattern="[0-9]+"></td>
                    <td class="total-price">54.00</td>
                    <td>
                        <button type="button" id="" class="delete-customer btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">
                            <span class="bi bi-trash-fill text-danger" style="font-size: 16px !important;"></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div style="background-color: #fff; position: fixed; z-index: 99; bottom: 0px; height: 60px; width: 100%; display: flex; justify-content: space-between; align-items: center">
        <div style=" display: flex; justify-content: space-between; align-items: center; margin-left: 15px">
            <h1>GHc </h1>
            <h1>108.00</h1>
        </div>
        <button class="btn btn-success" style="padding: 20px"  data-mdb-toggle="modal" data-mdb-target="#checkoutItems">Checkout</button>
    </div>

    <!-- Add Item Modal -->
    <div class="modal fade" id="checkoutItems" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="checkoutItemsLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutItemsLabel">Checkout</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--log in fields-->
                    <form method="post" id="add-item-form">
                        <!-- Email input -->
                        <div class="mb-4">
                            <label class="form-label" for="item-name">Customer</label>
                            <input type="text" id="item-name" name="item-name" class="form-control" />
                        </div>
                        <!-- Email input -->
                        <div class="mb-4">
                            <label class="form-label" for="payment-method">Payment Method</label>
                            <select name="payment-method" id="" class="form-select">
                                <option value="" hidden>Choose</option>
                                <option value="MOMO">MOMO</option>
                                <option value="CASH">CASH</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="item-unitprice">How much is customer paying? (GHc)</label>
                            <input type="text" id="item-unitprice" name="item-unitprice" class="form-control" />
                        </div>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".back").click(function(){
                window.location.href = "dashboard.php";
            });

            $(".item-qty").on("keyup", function() {
                alert("JS: "+ this.value)
                alert("JQ: "+ $(this).val())
                    alert("NUMERIC " + $(this).siblings('.unit-price').text())
                if (!isNaN($(this).val())) {
                    var siblingText = parseFloat($(this).siblings('.unit-price').text());
                    var qty = parseInt($(this).val());
                    var total = qty * siblingText;
                    $(this).siblings('.total-price').text(total);
                }   else {
                    alert("NON")
                }
            })
        });
    </script>
</body>

</html>