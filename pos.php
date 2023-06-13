<?php
session_start();
if (!isset($_SESSION["user"])) header("Location: index.php");
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}
require_once('classes/Inventory.php');
require_once('classes/Customer.php');
$Inventory = new Inventory();
$Customer = new Customer();
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
            cursor: pointer;
            position: absolute;
            right: 15px;
            font-size: 50px;
            border-radius: 50px;
            color: green;
            bottom: 0px;
        }

        .search-list .list-item {
            cursor: pointer;
        }
    </style>
</head>

<body class="fluid-container">

    <header style="position: relative !important; width: 100% !important; height: 60px !important; display: flex; justify-content: center; align-items: center">
        <span style="flex-grow: 1" class="bi bi-arrow-left back" style="color: #fff !important; font-size: 26px !important"></span>
        <h1 style="flex-grow: 8">POS</h1>
        <?php require_once('inc/header.php') ?>
    </header>

    <div style="position: relative !important; margin-top: 0px !important;">
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>SN</th>
                    <th>Item</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="purchase-item-list">
                <?php
                $items = $Inventory->getAllItems($_SESSION["user"]);

                if (!empty($items)) {
                    $index = 1;
                    foreach ($items as $item) {
                ?>
                        <tr>
                            <td><?= $index ?></td>
                            <td><?= $item["item_name"] ?></td>
                            <td class="unit-price" id="up<?= $item["item_id"] ?>"><?= $item["unit_price"] ?></td>
                            <td><input type="number" id="qty<?= $item["item_id"] ?>" class="form-control item-qty" style="width: 80px" pattern="[0-9]+" value="0"></td>
                            <td>
                                <input type="checkbox" name="item[]" id="<?= $item["item_id"] ?>" class="item">
                            </td>
                        </tr>
                <?php
                        $index++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div style="background-color: #333; color: #fff; position: fixed; z-index: 99; bottom: 0px; height: 60px; width: 100%; display: flex; justify-content: space-between; align-items: center; padding: 50px 15px">
        <div style=" display: flex; justify-content: space-between; align-items: center;">
            <h1>GHc </h1>
            <h1 id="total-price-display">0.00</h1>
        </div>
        <button class="btn btn-success" style="padding: 20px; max-width: 200px; min-width: 150px; font-size: 18px" data-mdb-toggle="modal" data-mdb-target="#checkoutItems">Checkout</button>
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
                    <form method="post" id="sell-product-form">
                        <!-- Email input -->
                        <div class="mb-4">
                            <label class="form-label" for="item-name">Customer</label>
                            <select name="customer-list" id="customer-list">
                                <option value="" hidden>Choose a customer</option>
                                <?php
                                $customers = $Customer->getAllCustomers($_SESSION["user"]);
                                if (!empty($customers)) {
                                    foreach ($customers as $customer) {
                                ?>
                                        <option value="<?= $customer["cust_id"] ?>"><?= $customer["name"] . " - " . $customer["address"] ?></option>
                                <?php
                                    }
                                }
                                ?>
                                <option value="non">Non customer</option>
                            </select>
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
                        <div class="mb-4 row">
                            <label class="form-label" for="customer-deposit">How much is customer paying? (GHc)</label>
                            <input type="text" id="customer-deposit" name="customer-deposit" class="form-control" />
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
            $(".back").click(function() {
                window.location.href = "dashboard.php";
            });

            var listOfProducts = {};

            function productTotalPrice() {
                total = 0;
                for (let item in listOfProducts) {
                    if (listOfProducts.hasOwnProperty(item)) {
                        total += listOfProducts[item]["total"];
                    }
                }
                $('#total-price-display').html(total);
            }

            $(".item").on("change", function() {
                var item_id = $(this).attr("id");
                var qty = parseInt($("#qty" + item_id).val());
                var unit_p = parseFloat($("#up" + item_id).text()).toFixed(2);
                if (qty < 1) {
                    alert("Quantity of this product must not be 0");
                    $(this).prop("checked", "")
                }
                if ($(this).is(":checked")) {
                    var total = qty * unit_p;
                    listOfProducts[item_id] = {
                        "quantity": qty,
                        "unit_price": unit_p,
                        "total": total
                    }
                    $("#qty" + item_id).prop("disabled", "true")
                } else {
                    delete listOfProducts[item_id];
                    $("#qty" + item_id).prop("disabled", "")
                }
                productTotalPrice();
            });

            $("#sell-product-form").on("submit", function(e) {
                e.preventDefault();
                formData = new FormData(this);
                formData.append("items", JSON.stringify(listOfProducts));

                $.ajax({
                    type: "POST",
                    url: "api/sell-products",
                    data: formData,
                }).done(function(data) {
                    console.log(data);
                    alert(data["message"]);
                }).fail(function(error) {
                    console.log(error);
                });
            });

            var purchase_item_list = {};

            $(".item-qty").on("keyup", function() {
                alert("JS: " + this.value)
                alert("JQ: " + $(this).val())
                alert("NUMERIC " + $(this).siblings('.unit-price').text())
                if (!isNaN($(this).val())) {
                    var siblingText = parseFloat($(this).siblings('.unit-price').text());
                    var qty = parseInt($(this).val());
                    var total = qty * siblingText;
                    $(this).siblings('.total-price').text(total);
                } else {
                    alert("NON")
                }
            });

            $("#search-item").on("keyup", (data) => {
                if (data.target.value.length < 1) return;

                let formData = {
                    _data: data.target.value
                }

                $.ajax({
                    type: "POST",
                    url: "api/fetch-item-list",
                    data: formData,
                }).done(function(data) {
                    console.log(data);
                    if (data["success"]) {
                        $("#itm-name").val(data["message"][0]["item_name"]);
                        $("#itm-description").val(data["message"][0]["description"]);
                        $("#itm-unitprice").val(data["message"][0]["unit_price"]);
                        $("#itm-quantity").val(data["message"][0]["quantity"]);
                        $("#itm-id").val(data["message"][0]["item_id"])
                    }
                }).fail(function(error) {
                    console.log(error);
                })
            });

            $(".list-item").on("click", function() {
                let dataT = {
                    _data: $(this).attr('id')
                }

                $.ajax({
                    type: "POST",
                    url: "api/fetch-item-for-purchase",
                    data: dataT,
                }).done(function(res) {
                    console.log(res);
                    if (res["success"]) {

                        let itemObj = {
                            item_name: res["message"][0]["item_name"],
                            unit_price: res["message"][0]["unit_price"]
                        }

                        purchase_item_list[res["message"][0]["item_id"]] = itemObj;

                        let tr = '<tr>' +
                            '<td>1</td>' +
                            '<td>' + itemObj.item_name + '</td>' +
                            '<td class="unit-price">' + itemObj.unit_price + '</td>' +
                            '<td><input type="number" id="" class="form-control item-qty" style="width: 80px" pattern="[0-9]+"></td>' +
                            '<td class="total-price">54.00</td>' +
                            '<td>' +
                            '<button type="button" id="" class="delete-customer btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">' +
                            '<span class="bi bi-trash-fill text-danger" style="font-size: 16px !important;"></span>' +
                            '</button>' +
                            '</td>' +
                            '</tr>';

                        $("#purchase-item-list").append(tr)
                    }
                }).fail(function(error) {
                    console.log(error);
                })
            })
        });
    </script>
</body>

</html>