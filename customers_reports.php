<?php
session_start();
if (!isset($_SESSION["user"])) header("Location: index.php");
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}
require_once('classes/Customer.php');
$customer = new Customer();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reports</title>
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
        <h1 style="flex-grow: 8">Reports - Customers</h1>
        <?php require_once('inc/header.php') ?>
    </header>

    <div style="position: relative !important; margin-top: 0px !important">
        <!-- Filter Form -->
        <form id="customers-reports-form" method="post">
            <div class="row mb-3">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="reportType" class="form-label">Filter By City/Location</label>
                        <select class="form-select" id="reportCity" name="reportCity">
                            <option value="">Choose</option>
                            <?php
                            $cities = $customer->getCustomersCityGrouped($_SESSION["user"]);
                            $totalCount = 0;
                            foreach ($cities as $city) {
                            ?>
                                <option value="<?= $city["city"] ?>"><?= $city["city"] ?></option>
                            <?php
                                $totalCount += 1;
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="reportType" class="form-label">Filter By Sex</label>
                        <select class="form-select" id="reportGender" name="reportGender">
                            <option value="">Choose</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
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
                        <label for="endDate" class="form-label">End Date</label>
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
                    <a href="print_reports.php" class="btn btn-link"> Print</a>
                </h3>
            </div>

            <table class="table table-bordered">
                <!-- Table rows with report data will be generated dynamically -->
                <?php
                $user_customers = $customer->getAllCustomers($_SESSION["user"]);

                if (!empty($user_customers)) {
                ?>
                    <table class="table align-middle mb-0 bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>SN.</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>City/Location</th>
                                <th>Added at</th>
                            </tr>
                        </thead>
                        <tbody id="customers-reports-tb">
                            <?php
                            $i = 1;
                            foreach ($user_customers as $customer) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $i ?>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/icons8-user-96.png" class="rounded-circle" alt="" style="width: 45px; height: 45px" />
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1"><?= $customer["name"] ?></p>
                                                <p class="text-muted mb-0"><?= $customer["number"] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $customer["gender"] ?></td>
                                    <td><?= $customer["city"] ?></td>
                                    <td><?= $customer["added_at"] ?></td>
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
                    <div>No Items</div>
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

            $("#customers-reports-form").on("submit", function(e) {
                e.preventDefault();
                console.log(new FormData(this))
                $.ajax({
                    type: "POST",
                    url: "api/customers-reports",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    if (data["success"]) {
                        $("#customers-reports-tb").html('');
                        var totalCount = 0;
                        $.each(data.message, function(index, value) {
                            $("#customers-reports-tb").append(
                                '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' +
                                '<div class="d-flex align-items-center">' +
                                '<img src="assets/images/icons8-user-96.png" class="rounded-circle" alt="" style="width: 45px; height: 45px" />' +
                                '<div class="ms-3">' +
                                '<p class="fw-bold mb-1">' + value["name"] + '</p>' +
                                '<p class="text-muted mb-0">' + value["number"] + '</p>' +
                                '</div>' +
                                '</div>' +
                                '</td>' +
                                '<td>' + value["gender"] + ' </td>' +
                                '<td>' + value["city"] + ' </td>' +
                                '<td>' + value["added_at"] + ' </td>' +
                                '</tr>'
                            );
                            totalCount += 1;
                        });
                        $("#totalRecordsHead").show();
                        $("#totalRecords").text(totalCount);
                    }
                    else{
                        $("#totalRecordsHead").hide();
                        $("#customers-reports-tb").html('<div class="text-center">No results found.</div>');

                    }

                }).fail(function(error) {
                    console.log(error);
                });
            })
        })
    </script>
</body>

</html>