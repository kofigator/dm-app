<?php
session_start();
if (!isset($_SESSION["user"])) header("Location: index.php");
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}

require_once('classes/Sale.php');
$sale = new Sale();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debt Reports</title>
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
        <h1 style="flex-grow: 8">Debts</h1>
        <?php require_once('inc/header.php') ?>
    </header>

    <div style="position: relative !important; margin-top: 0px !important">

        <!-- Report Results Table -->
        <div class="mt-4" style="margin: 0 15px;">
            <div style="display: flex; justify-content: space-between">
                <h3>Total in debt: <span id="total-debt">0.00</span></h3>
            </div>

            <table class="table table-bordered">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>SN.</th>
                            <th>Customer Name</th>
                            <th>Customer City</th>
                            <th>Amount owing (GHC)</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    $data = $sale->fetchAmountCustomerOwes($_SESSION["user"]);
                    if (!empty($data)) {
                    ?>
                        <tbody id="">
                            
                            <?php 
                                $rowNum = 1;
                                foreach ($data as $d) {
                            ?>
                                <tr>
                                    <th><?= $rowNum ?></th>
                                    <td><?= $d["name"] ?></td>
                                    <td><?= $d["city"] ?></td>
                                    <td><?= $d["amount_owing"] ?></td>
                                    <td>
                                        <button id="<?= $d["cust_id"] ?>" class="settle-debt btn btn-primary btn-rounded btn-sm fw-bold" data-mdb-toggle="modal" data-mdb-target="#settleDebtModal" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Settle debt">Settle Debt</button>
                                    </td>
                                    <td>
                                        <button class="view-history btn btn-danger btn-rounded btn-sm fw-bold" data-mdb-toggle="modal" data-mdb-target="#addCustomer" data-mdb-toggle="tooltip" data-mdb-placement="top" title="Settle debt">View History</button>
                                    </td>
                                </tr>
                        <?php
                            $rowNum++;
                            }
                        }
                        ?>
                        </tbody>
                </table>
            </table>
        </div>
    </div>

    <!-- Add Item Modal -->
    <div class="modal fade" id="settleDebtModal" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="settleDebtModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="settleDebtModalLabel">Checkout</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--log in fields-->
                    <form method="post" id="settle-debt-form">

                        <div class="mb-4" style="border: 1px solid #eee; background-color: #eee">
                            <label class="form-label" for="total-price" style="color: #000; font-size: larger;">Outstanding Amount</label>
                            <input type="text" disabled name="total-price" id="total-price" style="color: #000; width: 100%; font-size: 42px; border: none; background-color: #eee" />
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

                        <input type="hidden" id="customer-id" name="customer-id">
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

            // Calculate and display the total debt amount
            calculateTotalDebt();

            function calculateTotalDebt() {
                let totalDebt = 0;
                $('.table tbody tr').each(function() {
                    const amountOwing = parseFloat($(this).find('td:eq(2)').text());
                    totalDebt += amountOwing;
                });
                $('#total-debt').text(totalDebt.toFixed(2));
            }

            $(".settle-debt").on("click", function() {
                $("#customer-id").val($(this).attr("id"));
            });

            $("#settle-debt-form").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "api/settle-debts",
                    data: new FormData(this),
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

        })
    </script>
</body>

</html>