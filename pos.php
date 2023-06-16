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
                    <th>In-Stock</th>
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
                            <td><?= $item["quantity"] ?></td>
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

    <div id="checkout-div" style="display: none;">
        <div style="background-color: #333; color: #fff; position: fixed; z-index: 99; bottom: 0px; height: 60px; width: 100%; display: flex; justify-content: space-between; align-items: center; padding: 50px 15px">
            <div style=" display: flex; justify-content: space-between; align-items: center;">
                <h1>GHS </h1>
                <h1 id="total-price-display">0.00</h1>
            </div>
            <button id="checkoutBtn" class="btn btn-success" style="padding: 20px; max-width: 200px; min-width: 150px; font-size: 18px" data-mdb-toggle="modal" data-mdb-target="#checkoutItems">Checkout</button>
        </div>
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
                        <div class="mb-4" style="border: 1px solid #eee; background-color: #eee">
                            <label class="form-label" for="total-price" style="color: #000; font-size: larger;">Total Purchase Amount</label>
                            <input type="text" disabled name="total-price" id="total-price" style="color: #000; width: 100%; font-size: 42px; border: none; background-color: #eee" />
                        </div>

                        <!-- Email input -->
                        <div class="mb-4">
                            <div>
                                <label for="buyer-type">Buyer is a </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input is-buyer" required type="radio" name="buyer-type" id="is-customer" value="option1" />
                                    <label class="form-check-label" for="is-customer">Customer</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input is-buyer" required type="radio" name="buyer-type" id="is-not-customer" value="option2" />
                                    <label class="form-check-label" for="is-not-customer">Not a customer</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4" id="c-is-customer" style="display: none">
                            <label class="form-label" for="item-name">Customer</label>
                            <select name="customer-list" id="customer-list" class="form-select">
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
                            </select>
                        </div>

                        <div class="mb-4" id="c-is-not-customer" style="display: none">
                            <div class="form-outline mb-4">
                                <input type="text" id="buyer-name" name="buyer-name" class="form-control" />
                                <label class="form-label" for="buyer-name">Buyer Name</label>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="buyer-phone" name="buyer-phone" class="form-control" />
                                <label class="form-label" for="buyer-phone">Buyer Phone Number</label>
                            </div>

                            <div class="mb-4">
                                <label class="me-2">Buyer Sex</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="buyer-gender" id="female" value="F" />
                                    <label class="form-check-label" for="female">Female</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="buyer-gender" id="male" value="M" />
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="buyer-city" name="buyer-city" class="form-control" />
                                <label class="form-label" for="buyer-city">Buyer City/Location</label>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="buyer-address" name="buyer-address" class="form-control" />
                                <label class="form-label" for="buyer-address">Buyer Address</label>
                            </div>
                        </div>

                        <!-- Email input -->
                        <div class="mb-4">
                            <label class="form-label" for="payment-method">Payment Method</label>
                            <select name="payment-method" id="payment-method" class="form-select" required>
                                <option value="" hidden>Choose</option>
                                <option value="MOMO">MOMO</option>
                                <option value="CASH">CASH</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="customer-deposit">Amount paid? (GHS)</label>
                            <input type="text" id="customer-deposit" required name="customer-deposit" class="form-control" />
                        </div>

                        <div class="mb-4" style="border: 1px solid #eee; background-color: #eee">
                            <label class="form-label" for="amount-owing" style="color: #000; font-size: larger;">Amount owing</label>
                            <input type="text" class="col-10" disabled name="amount-owing" id="amount-owing" style="color: #000; width: 100%; font-size: 32px; border: none; background-color: #eee" value="GHS 0.00" />
                        </div>

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
            var totalPrice = 0;

            function productTotalPrice() {
                total = 0;
                for (let item in listOfProducts) {
                    if (listOfProducts.hasOwnProperty(item)) {
                        total += listOfProducts[item]["total"];
                    }
                }
                totalPrice = total.toFixed(2);
                $('#total-price-display').html(total.toFixed(2));

                if (total) $("#checkout-div").slideDown();
                else $("#checkout-div").slideUp();
            }

            $(".item").on("change", function() {
                var item_id = $(this).attr("id");
                var qty = parseInt($("#qty" + item_id).val());
                var unit_p = parseFloat($("#up" + item_id).text()).toFixed(2);

                if (qty < 1) {
                    alert("Quantity of this product must not be 0");
                    $(this).prop("checked", "")
                    return;
                }

                if ($(this).is(":checked")) {
                    var total = qty * unit_p;
                    listOfProducts[item_id] = {
                        "id": item_id,
                        "quantity": qty,
                        "unit_price": unit_p,
                        "total": total
                    }
                    $("#qty" + item_id).prop("disabled", "true");
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
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    alert(data["message"]);
                    if (data["success"]) window.location.reload();
                }).fail(function(error) {
                    console.log(error);
                });
            });

            $("#checkoutBtn").on("click", function() {
                $("#total-price").val("GHS " + totalPrice)
            });

            $("#customer-deposit").on("keyup", function() {
                let deposit = $(this).val();
                if (deposit == "") return;
                if (!isNaN($(this).val())) {
                    setTimeout(function() {
                        console.log($(this).val())
                    }, 2000)
                }
            });

            $(".is-buyer").on("change", function() {
                if ($(this).is(":checked")) {
                    let id = $(this).attr("id");
                    if (id == "is-customer") {
                        $("#c-is-customer").slideDown();
                        $("#c-is-not-customer").slideUp();
                    }
                    if (id == "is-not-customer") {
                        $("#c-is-customer").slideUp();
                        $("#c-is-not-customer").slideDown();
                    }
                }
            })

        });
    </script>
</body>

</html>