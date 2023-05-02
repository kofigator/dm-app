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

  <form>
    <fieldset>
      <legend>Register</legend>
      <div class="form-outline mb-4">
        <input type="text" id="first-name" name="first-name" class="form-control" />
        <label class="form-label" for="first-name">Your First Name</label>
      </div>

      <div class="form-outline mb-4">
        <input type="text" id="last-name" name="last-name" class="form-control" />
        <label class="form-label" for="last-name">Your Last Name</label>
      </div>

      <div class="form-outline mb-4">
        <input type="email" id="email-addr" name="email-addr" class="form-control" />
        <label class="form-label" for="email-addr">Your Email</label>
      </div>

      <div class="form-outline mb-4">
        <input type="password" id="password" name="password" class="form-control" />
        <label class="form-label" for="password">Password</label>
      </div>

      <div class="form-outline flex-fill mb-4">
        <input type="password" id="repeat-password" name="repeat-password" class="form-control" />
        <label class="form-label" for="repeat-password">Repeat your password</label>
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

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>

</body>

</html>