<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
   <title>Login Page</title>
</head>
<body>
   <div class="container mt-5">
      <div class="row justify-content-center">
         <div class="col-lg-4 col-md-6 col-sm-8">
            <h3 class="text-center mb-4">Login</h3>
            <form action="" method="" id="Login-Form">
               <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email">
               </div>
               <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
               </div>
               <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Login</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>


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

                    if (!data.success) {
                        alert(data.message);
                        return;
                    }



                }).fail(function(error) {
                    console.log(error);
                })
            });

        });
    </script>
</body>

</html>