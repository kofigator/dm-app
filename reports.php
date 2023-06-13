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
    <title>Reports</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body class="fluid-container">

    <div class="container mt-4">
    <header style="position: relative !important; width: 100% !important; height: 60px !important;">
        <h1>Reports</h1>
        <a href="logout.php" style="position: absolute; top: 10px; right: 10px; color: #fff; text-decoration: none;">
            Logout
        </a>
    </header>

        <!-- Filter Form -->
        <form id="reports-form" method="post">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="reportType">Report Type</label>
                    <select class="form-select" id="reportType" name="reportType">
                        <option value="inventory">Inventory</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="startDate">Start Date</label>
                    <input type="date" class="form-control" id="startDate" name="startDate">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="endDate">End Date</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>

        <!-- Report Results Table -->
        <div class="mt-4">
            <h2>Report Results</h2>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Report Type</th>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows with report data will be generated dynamically -->
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>Inventory</td>
                        <td>2023-05-01</td>
                        <td>$500</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#reports-form").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "api/generate-report",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    if (data.success) {
                        window.location.href = "reports.php";
                    }
                    alert(data.message);
                    return;
                }).fail(function(error) {
                    console.log(error);
                })
            });

        });
    </script>
</body>

</html>
