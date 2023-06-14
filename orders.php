<?php
session_start();
if (isset($_SESSION["user"])) header("Location: dashboard.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Orders Form</title>
    <!--<link rel="stylesheet" href="../CSS/regStyle.css" />-->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .body>form {
            height: 100% !important;
            width: 100% !important;
        }

        form {
            max-width: 500px;
        }

        #bg {
            background-image: url("assets/images/bg11.jpg");
        }
    </style>
</head>

<body class="fluid-container">

    <form id="order-form" method="post">
        <fieldset>
            <legend>Orders Form</legend>
            <div class="form-outline mb-4">
                <input type="text" id="first-name" name="first-name" class="form-control" />
                <label class="form-label" for="first-name">Item Name</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="last-name" name="last-name" class="form-control" />
                <label class="form-label" for="last-name">Description</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="last-name" name="last-name" class="form-control" />
                <label class="form-label" for="last-name">Quantity</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="phone" name="phone" class="form-control" />
                <label class="form-label" for="phone">Budgetted Price</label>
            </div>

            <div class="form-outline mb-4">
                <input type="date" id="email-addr" name="email-addr" class="form-control" />
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="password" name="password" class="form-control" />
                <label class="form-label" for="password">Phone Number</label>
            </div>

            <div class="form-outline flex-fill mb-4">
                <input type="text" id="repeat-password" name="repeat-password" class="form-control" />
                <label class="form-label" for="repeat-password">Address[Town]</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block mb-4">Save</button>

        </fieldset>
    </form>

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#order-form").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "api/orders",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    if (data.success) {
                        window.location.href = "index.php";
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