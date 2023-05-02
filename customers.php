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
    <title>Login Page</title>
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

    <ul class="list-group list-group-light">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <div class="fw-bold">John Doe</div>
                <div class="text-muted">0244123456</div>
            </div>
            <span class="bi bi-pencil-square text-info"></span>
            <span class="bi bi-pencil-square text-info"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <div class="fw-bold">Alex Ray</div>
                <div class="text-muted">0244123456</div>
            </div>
            <span class="bi bi-pencil-square text-info"></span>
            <span class="bi bi-pencil-square text-info"></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <div class="fw-bold">Kate Hunington</div>
                <div class="text-muted">0244123456</div>
            </div>
            <span class="bi bi-pencil-square text-info"></span>
            <span class="bi bi-pencil-square text-info"></span>
        </li>
    </ul>

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#Login-Form").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "api/login",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    if (data.success) {
                        window.location.href = "dashboard.php";
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