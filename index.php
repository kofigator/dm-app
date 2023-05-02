<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="../CSS/main_style.css">-->

    <title>Login Page</title>
</head>

<body>

    <!--Background-->
    <div id="bg"></div>

    <!--log in fields-->
    <form id="Login-Form" method="post">
        <div class="form-field">
            <input type="email" name="email" id="email" placeholder="Email / Username" required />
        </div>

        <div class="form-field">
            <input type="password" name="password" id="password" placeholder="Password" required />
        </div>

        <div class="form-field">

            <!-- <button class="btn" type="submit">Log in</button> -->
            <button type="submit" class="btn">Log in</button>

            <button class="btn" onclick="window.location.href='registration.html';">Register</button>
        </div>
    </form>

    <script src="js/jquery-3.6.0.min.js"></script>
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