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
    </style>
</head>

<body class="fluid-container">

    <header style="position: relative !important; width: 100% !important; height: 60px !important; display: flex; justify-content: center; align-items: center">
        <span style="flex-grow: 1" class="bi bi-arrow-left back" style="color: #fff !important; font-size: 26px !important"></span>
        <h1 style="flex-grow: 8">Inventory</h1>
        <?php require_once('inc/header.php') ?>
    </header>


    <!--<li class="dropdown">
                <span class="dropbtn" data-mdb-toggle="modal" data-mdb-target="#addItem"><img src="add.jpg" alt="" width="35px" height="35px"></span>
            </li>-->

    <div style="position: relative !important; margin-top: 0px !important">

        <div style="display: flex; justify-content: space-between">
            <h3 style="margin: 15px 5px;">Total Expenditure: <span id="total-expenditure">0.00</span></h3>
            <h3 style="margin: 15px 5px;">Expected Profit: <span id="total-profit">0.00</span></h3>
        </div>
        <?php
        $user_items = $Inventory->getAllItems($_SESSION["user"]);

        if (!empty($user_items)) {
        ?>
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>SN.</th>
                        <th>Item Names and description</th>
                        <th>Cost Price</th>
                        <th>Selling Price</th>
                        <th>Quantity</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($user_items as $Inventory) {
                    ?>
                        <tr>
                            <td>
                                <?= $i ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="assets/images/icons8-open-box-50.png" class="rounded-circle" alt="" style="width: 45px; height: 45px" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1"><?= $Inventory["item_name"] ?></p>
                                        <p class="text-muted mb-0"><?= $Inventory["description"] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p class="fw-bold mb-1"><?= $Inventory["cost_price"] ?></p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p class="fw-bold mb-1"><?= $Inventory["unit_price"] ?></p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p class="fw-bold mb-1"><?= $Inventory["quantity"] ?></p>
                                </div>
                            </td>
                            <td>
                                <button type="button" id="<?= $Inventory["item_id"] ?>" class="edit-item btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#editItem">
                                    <span class="bi bi-pencil-fill" style="font-size: 18px !important;"></span>
                                </button>
                            </td>
                            <td>
                                <button type="button" id="<?= $Inventory["item_id"] ?>" class="delete-customer btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">
                                    <span class="bi bi-trash-fill text-danger" style="font-size: 18px !important;"></span>
                                </button>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
        ?>
            <div>No Items Found</div>
        <?php
        }
        ?>
    </div>

    <span class="bi bi-plus-circle-fill add-new-element" data-mdb-toggle="modal" data-mdb-target="#addItem"></span>


    <!-- Add Item Modal -->
    <div class="modal fade" id="addItem" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="addItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemLabel">Add new Item</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--log in fields-->
                    <form method="post" id="add-item-form">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input required type="text" id="item-name" name="item-name" class="form-control" />
                            <label class="form-label" for="item-name">Name</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="item-description" name="item-description" class="form-control" />
                            <label class="form-label" for="item-description">Description</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input required type="text" id="item-costprice" name="item-costprice" class="form-control" />
                            <label class="form-label" for="item-costprice">Cost Price</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input required type="text" id="item-unitprice" name="item-unitprice" class="form-control" />
                            <label class="form-label" for="item-unitprice">Selling Price</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input required type="number" id="item-quantity" name="item-quantity" min="1" pattern="[0-9]" class="form-control" />
                            <label class="form-label" for="item-quantity">Quantity</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Item Modal -->
    <div class="modal fade" id="editItem" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="editItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemLabel">Edit Item Details</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--log in fields-->
                    <form method="post" id="edit-item-form">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="itm-name" name="itm-name" class="form-control" />
                            <label class="form-label" for="itm-name">Name</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="itm-description" name="itm-description" class="form-control" />
                            <label class="form-label" for="itm-description">Description</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="text" id="itm-costprice" name="itm-costprice" class="form-control" />
                            <label class="form-label" for="itm-costprice">Cost Price</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="text" id="itm-unitprice" name="itm-unitprice" class="form-control" />
                            <label class="form-label" for="itm-unitprice">Selling Price</label>
                        </div>
                        <div class="mb-4" id="profit-div">
                            <input disabled type="text" id="profit-field" style="border: none !important" class="form-control" />
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="number" id="itm-quantity" name="itm-quantity" class="form-control" />
                            <label class="form-label" for="itm-quantity">Quantity</label>
                        </div>

                        <input type="hidden" name="itm-id" id="itm-id" value="">

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

            calculateTotalExpenditure();

            function calculateTotalExpenditure() {
            let totalDebt = 0;
            $('.table tbody tr').each(function() {
                const expenses = parseFloat($(this).find('td:eq(2)').text());
                const quantity = parseFloat($(this).find('td:eq(4)').text());
                if (!isNaN(expenses) && !isNaN(quantity)) {
                const totalExpenses = expenses * quantity;
                totalDebt += totalExpenses; // Accumulate the total expenses for each row
                }
            });
            $('#total-expenditure').text(totalDebt.toFixed(2));
            }

            calculateTotalProfit();

            function calculateTotalProfit() {
            let totalProfit = 0;
            $('.table tbody tr').each(function() {
                const expenses = parseFloat($(this).find('td:eq(2)').text());
                const totalSellingPrice = parseFloat($(this).find('td:eq(3)').text());
                const quantity = parseFloat($(this).find('td:eq(4)').text());
                if (!isNaN(expenses) && !isNaN(totalSellingPrice) && !isNaN(quantity)) {
                const profit = (totalSellingPrice - expenses) * quantity;
                totalProfit += profit; // Accumulate the total profit for each row
                }
            });
            $('#total-profit').text(totalProfit.toFixed(2));
            }



            $("#itm-unitprice").on("keyup", function() {
                var cost_p = parseFloat($("#itm-costprice").val());
                var unit_p = parseFloat($(this).val());

                if ($(this).val() != "" && $("#itm-costprice").val() != "") {
                    setTimeout(function() {
                        let profit = unit_p - cost_p;
                        $("#profit-field").val("PROFIT: " + profit.toFixed(2))
                    }, 2000);
                }
            });

            $("#add-item-form").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "api/add-item",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    alert(data["message"]);
                    window.location.reload();
                }).fail(function(error) {
                    console.log(error);
                });
            });


            $(".edit-item").on("click", function(e) {
                data = {
                    item_id: $(this).attr("id")
                }
                $.ajax({
                    type: "POST",
                    url: "api/fetch-item-data",
                    data: data,
                }).done(function(data) {
                    console.log(data);
                    if (data["success"]) {
                        $("#itm-name").val(data["message"][0]["item_name"]);
                        $("#itm-description").val(data["message"][0]["description"]);
                        $("#itm-costprice").val(data["message"][0]["cost_price"]);
                        $("#itm-unitprice").val(data["message"][0]["unit_price"]);
                        $("#itm-quantity").val(data["message"][0]["quantity"]);
                        $("#itm-id").val(data["message"][0]["item_id"]);

                        var cost_p = parseFloat($("#itm-costprice").val());
                        var unit_p = parseFloat($("#itm-unitprice").val());

                        setTimeout(function() {
                            let profit = unit_p - cost_p;
                            $("#profit-field").val("PROFIT: " + profit.toFixed(2))
                        }, 2000);

                    }
                }).fail(function(error) {
                    console.log(error);
                })
            });

            $("#edit-item-form").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "api/edit-item",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    alert(data["message"]);
                    window.location.reload();
                }).fail(function(error) {
                    console.log(error);
                })
            });

            $(".delete-customer").on("click", function(e) {

                if (confirm("Are you sure you want to delete this customer data")) {
                    data = {
                        item_id: $(this).attr("id")
                    }
                    $.ajax({
                        type: "POST",
                        url: "api/delete-item",
                        data: data,
                    }).done(function(data) {
                        console.log(data);
                        alert(data["message"]);
                        window.location.reload();
                    }).fail(function(error) {
                        console.log(error);
                    })
                }
            });

            $(".btn-close").click(function() {
                window.location.reload();
            })

        });
    </script>
</body>

</html>