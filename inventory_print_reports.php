<?php
session_start();
if (!isset($_SESSION["user"])) header("Location: index.php");
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}

require_once('classes/User.php');
require_once('classes/Customer.php');
require_once('classes/Inventory.php');
require_once('classes/Report.php');
require_once('classes/Sale.php');
require_once('classes/DataController.php');

$report = new Report();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Reports</title>
</head>

<body>
    <h1><?= ucfirst($_SESSION["print_reports"]["name"]) ?> Report</h1>
    <table class="table table-bordered">
        <!-- Table rows with report data will be generated dynamically -->
        <?php
        $report_data = $report->getReport($_SESSION["print_reports"]);

        if (!empty($report_data)) {
        ?>
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>SN.</th>
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Cost</th>
                        <th>Unit Price</th>
                        <th>Profit on Each Item</th>
                        <th>Added at</th>
                    </tr>
                </thead>
                <tbody id="inventory-reports-tb">
                    <?php
                    $i = 1;
                    foreach ($report_data as $Inventory) {
                    ?>
                        <tr>
                            <td>
                                <?= $i ?>
                            </td>
                            <td style="width:200px"><?= $Inventory["item_name"] ?>
                            </td>
                            <td style="width:150px"><?= $Inventory["description"] ?>
                            </td>
                            <td style="width:50px"><?= $Inventory["cost_price"] ?></td>
                            <td><?= $Inventory["unit_price"] ?></td>
                            <td><?= $Inventory["profit"] ?></td>
                            <td><?= $Inventory["added_at"] ?></td>
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
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        window.print();
        window.close();
        window.location.href = "inventory_reports.php";
    });
</script>