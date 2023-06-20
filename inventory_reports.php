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
    <title>Inventory Reports</title>
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
            padding: 15px 15px;
        }

        .back {
            cursor: pointer;
        }

        #butt {
            margin: 33px 0px;
        }
    </style>
</head>

<body class="fluid-container">

    <header style="position: relative !important; width: 100% !important; height: 60px !important; display: flex; justify-content: center; align-items: center">
        <span style="flex-grow: 1" class="bi bi-arrow-left back" style="color: #fff !important; font-size: 26px !important"></span>
        <h1 style="flex-grow: 8">Reports - Inventory</h1>
        <?php require_once('inc/header.php') ?>
    </header>

    <div style="position: relative !important; margin-top: 0px !important">
        <!-- Filter Form -->
        <form id="items-reports-form" method="post">
            <div class="row mb-3">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="reportType" class="form-label">Filter By Sales Performance</label>
                        <select class="form-select" id="reportSale" name="reportSale">
                            <option value="">Choose</option>
                            <option value="">Most bought</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="startDate" class="form-label">Added at (Start Date)</label>
                        <input type="date" class="form-control" id="startDate" name="startDate">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="endDate" class="form-label">(End Date)</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" id="butt" class="btn btn-primary" style="width: 100%">Generate</button>
                </div>
            </div>
        </form>

        <!-- Report Results Table -->
        <div class="mt-4" style="margin: 0 15px;">
            <div style="display: flex; justify-content: space-between">
                <h3>Report Results</h3>
                <h3 style="display: none;" id="totalRecordsHead">Total records:
                    <span id="totalRecords"></span>
                    <a href="inventory_print_reports.php" class="btn btn-link"> Print</a>
                </h3>
            </div>

            <table class="table table-bordered">
                <!-- Table rows with report data will be generated dynamically -->
                <?php
                $user_inventory = $Inventory->getAllItems($_SESSION["user"]);

                if (!empty($user_inventory)) {
                ?>
                    <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>SN.</th>
                            <th>Item Name</th>
                            <th>Cost</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total Quantity Sold</th>
                            <th>Profit on Each Item</th>
                            <th>Total Profit</th>
                            <th>Added at</th>
                        </tr>
                    </thead>

                        <tbody id="inventory-reports-tb">
                            <?php
                            $i = 1;
                            foreach ($user_inventory as $Inventory) {
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
                                            </div>
                                        </div>
                                    </td>
                                    <?php $total = $Inventory["profit"] * $Inventory["quantity"]?>
                                    <td><?= $Inventory["cost_price"] ?></td>
                                    <td><?= $Inventory["unit_price"] ?></td>
                                    <td><?= $Inventory["quantity"] ?></td>
                                    <td>hello</td>
                                    <td><?= $Inventory["profit"] ?></td>
                                    <td>GH¢ <?= $total ?></td>
                                    <td><?= $Inventory["added_at"] ?></td>
                                </tr>
                            <?php
                                $tt = $i;
                                $i++;
                               
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                ?>
                    <div>No customers</div>
                <?php
                }
                ?>
            </table>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script>
        $(document).ready(function() {

            $(".back").click(function() {
                window.location.href = "reports.php";
            });

            $("#items-reports-form").on("submit", function(e) {
                e.preventDefault();
                console.log(new FormData(this))
                $.ajax({
                    type: "POST",
                    url: "api/items-reports",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    if (data["success"]) {
                        $("#inventory-reports-tb").html('');
                        var totalCount = 0;
                        $.each(data.message, function(index, value) {
                            $("#inventory-reports-tb").append(
                                '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' +
                                '<div class="d-flex align-items-center">' +
                                '<img src="assets/images/icons8-user-96.png" class="rounded-circle" alt="" style="width: 45px; height: 45px" />' +
                                '<div class="ms-3">' +
                                '<p class="fw-bold mb-1">' + value["item_name"] + '</p>' +
                                '</div>' +
                                '</div>' +
                                '</td>' +
                                '<td>' + value["description"] + ' </td>' +
                                '<td>' + value["cost_price"] + ' </td>' +
                                '<td>' + value["unit_price"] + ' </td>' +
                                '<td>' + value["profit"] + ' </td>' +
                                '<td>' + value["added_at"] + ' </td>' +
                                '</tr>'
                            );
                            totalCount += 1;
                        });
                        $("#totalRecordsHead").show();
                        $("#totalRecords").text(totalCount);
                    }

                }).fail(function(error) {
                    console.log(error);
                });
            })
        })
    </script>
</body>

</html>