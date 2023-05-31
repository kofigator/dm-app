<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="../CSS/main_style.css">-->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
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

    <!--log in fields-->
    <form method="post" id="Login-Form">
        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="email" id="email" name="email" class="form-control" />
            <label class="form-label" for="email">Email address</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <input type="password" id="password" name="password" class="form-control" />
            <label class="form-label" for="password">Password</label>
        </div>

        <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">
            <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="remember-me" name="remember-me" checked />
                    <label class="form-check-label" for="remember-me"> Remember me </label>
                </div>
            </div>

            <div class="col">
                <!-- Simple link -->
                <a href="forgetpass.php">Forgot password?</a>
            </div>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

        <!-- Register buttons -->
        <div class="text-center">
            <p>Not a member? <a href="registration.php">Register</a></p>
        </div>
    </form>

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