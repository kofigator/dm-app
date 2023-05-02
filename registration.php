<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Form</title>
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

  <form id="register-form" method="post">
    <fieldset>
      <legend>Register</legend>
      <div class="form-outline mb-4">
        <input type="text" id="first-name" name="first-name" class="form-control" />
        <label class="form-label" for="first-name">First Name</label>
      </div>

      <div class="form-outline mb-4">
        <input type="text" id="last-name" name="last-name" class="form-control" />
        <label class="form-label" for="last-name">Last Name</label>
      </div>

      <div class="mb-4">
        <label class="me-2">Gender</label>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" id="female" value="F" />
          <label class="form-check-label" for="female">Female</label>
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" id="male" value="M" />
          <label class="form-check-label" for="male">Male</label>
        </div>
      </div>

      <div class="form-outline mb-4">
        <input type="text" id="phone-num" name="phone-num" class="form-control" />
        <label class="form-label" for="phone-num">Phone Number</label>
      </div>

      <div class="form-outline mb-4">
        <input type="email" id="email-addr" name="email-addr" class="form-control" />
        <label class="form-label" for="email-addr">Email Address</label>
      </div>

      <div class="form-outline mb-4">
        <input type="password" id="password" name="password" class="form-control" />
        <label class="form-label" for="password">Password</label>
      </div>

      <div class="form-outline flex-fill mb-4">
        <input type="password" id="repeat-password" name="repeat-password" class="form-control" />
        <label class="form-label" for="repeat-password">Repeat password</label>
      </div>

      <div class="form-check d-flex justify-content-center mb-5">
        <input class="form-check-input me-2" type="checkbox" value="" id="agree-tnc" />
        <label class="form-check-label" for="agree-tnc">
          I agree all statements in <a href="#!">Terms of service</a>
        </label>
      </div>

      <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>

      <!-- Register buttons -->
      <div class="text-center">
        <p>Already a member? <a href="index.php">Login</a></p>
      </div>

    </fieldset>
  </form>

  <script src="js/jquery-3.6.0.min.js"></script>
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
  <script>
    $(document).ready(function() {

      $("#register-form").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "api/register",
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