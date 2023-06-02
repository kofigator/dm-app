<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
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
        }
    </style>
</head>

<body class="fluid-container">

    <header style="position: fixed !important; width: 100% !important; height: 80px !important">
        <h1>Dashboard</h1>
    </header>

    <main class="container" style="position: absolute !important; margin-top: 120px !important">
        <div class="row">
            <a href="customers.php" class="col-md-4 m-3 bg-success dashboard-item">
                <div style="padding: 35px">
                    Customers
                </div>
            </a>
            <a href="items.php" class="col-md-4 m-3 bg-success dashboard-item">
                <div style="padding: 35px">
                    Inventory
                </div>
            </a>
            <a href="pos.php" class="col-md-4 m-3 bg-success dashboard-item">
                <div style="padding: 35px">
                    POS
                </div>
            </a>
            <a href="reports.php" class="col-md-4 m-3 bg-success dashboard-item">
                <div style="padding: 35px">
                    Reports
                </div>
            </a>
        </div>
    </main>

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>

</body>

</html>