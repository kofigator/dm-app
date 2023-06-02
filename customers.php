<?php
session_start();
if (!isset($_SESSION["user"])) header("Location: index.php");
require_once('classes/Customer.php');
$customer = new Customer();
?>

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
    <title>Customers Page</title>
    <style>
        .body>form {
            height: 100% !important;
            width: 100% !important;
        }

        form {
            max-width: 500px;
        }

        #tableBody td {
            padding-right: 40px;
            padding-bottom: 20px;
        }

        .act_btn td {
            padding: 20px;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a,
        .dropbtn {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover,
        .dropdown:hover .dropbtn {
            background-color: rgb(236, 195, 195);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        #customer_header {
            margin: 5px 10px;
            color: #fff;

        }
        
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        header>h1 {
            text-align: center !important;
        }
        .back {
            cursor: pointer;
        }

        .add-new-element {
            cursor:pointer;
            position:absolute; 
            right: 15px; 
            font-size: 50px; 
            border-radius: 50px; 
            color: green;
            bottom: 0px;
        }
    </style>
</head>

<body class="fluid-container">

    <header style="position: relative !important; width: 100% !important; height: 60px !important; display: flex; justify-content: center; align-items: center">
        <span style="flex-grow: 1" class="bi bi-arrow-left back" style="color: #fff !important; font-size: 26px !important"></span>
        <h1 style="flex-grow: 8">Customers</h1>
    </header>

    <!--
        <li class="dropdown">
                <span class="dropbtn"><img src="add.jpg" alt="" width="35px" height="35px"></span>
            </li>
    -->

    <div style="position: relative !important; margin-top: 0px !important">
        <?php
        $user_customers = $customer->getAllCustomers($_SESSION["user"]);

        if (!empty($user_customers)) {
        ?>
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>SN.</th>
                        <th>Name</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($user_customers as $customer) {
                    ?>
                        <tr>
                            <td>
                                <?= $i ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="assets/images/icons8-user-96.png" class="rounded-circle" alt="" style="width: 45px; height: 45px" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1"><?= $customer["name"] ?></p>
                                        <p class="text-muted mb-0"><?= $customer["number"] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button type="button" id="<?= $customer["cust_id"] ?>" class="edit-customer btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#editCustomer">
                                    <span class="bi bi-pencil-fill" style="font-size: 18px !important;"></span>
                                </button>
                            </td>
                            <td>
                                <button type="button" id="<?= $customer["cust_id"] ?>" class="delete-customer btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">
                                    <span class="bi bi-trash-fill text-danger" style="font-size: 18px !important;"></span>
                                </button>
                            </td>
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
            <div>No customers</div>
        <?php
        }
        ?>
    </div>

    <span class="bi bi-plus-circle-fill add-new-element" data-mdb-toggle="modal" data-mdb-target="#addCustomer"></span>

    <!-- Add customer Modal -->
    <div class="modal fade" id="addCustomer" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="addCustomerLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerLabel">Add new customer</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--log in fields-->
                    <form method="post" id="add-customer-form">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="cust-name" name="cust-name" class="form-control" />
                            <label class="form-label" for="cust-name">Name</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="cust-phone" name="cust-phone" class="form-control" />
                            <label class="form-label" for="cust-phone">Phone Number</label>
                        </div>
                        <div class="mb-4">
                            <label class="me-2">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cust-gender" id="female" value="F" />
                                <label class="form-check-label" for="female">Female</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cust-gender" id="male" value="M" />
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="cust-address" name="cust-address" class="form-control" />
                            <label class="form-label" for="cust-address">Address</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit customer Modal -->
    <div class="modal fade" id="editCustomer" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="editCustomerLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerLabel">Edit customer information</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--log in fields-->
                    <form method="post" id="edit-customer-form">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="customer-name" name="customer-name" class="form-control" />
                            <label class="form-label" for="customer-name">Name</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="customer-phone" name="customer-phone" class="form-control" />
                            <label class="form-label" for="customer-phone">Phone Number</label>
                        </div>
                        <div class="mb-4">
                            <label class="me-2">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="customer-gender" id="female" value="F" />
                                <label class="form-check-label" for="female">Female</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="customer-gender" id="male" value="M" />
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="customer-address" name="customer-address" class="form-control" />
                            <label class="form-label" for="customer-address">Address</label>
                        </div>
                        <input type="hidden" name="customer-id" id="customer-id" value="">

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".back").click(function(){
                window.location.href = "dashboard.php";
            });

            $("#add-customer-form").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "api/add-customer", 
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    alert(data["message"]);
                    window.location.reload();
                }).fail(function(error) {
                    console.log(error);
                });
            });


            $(".edit-customer").on("click", function(e) {
                data = {
                    customer_id: $(this).attr("id")
                }
                $.ajax({
                    type: "POST",
                    url: "api/fetch-customer-data",
                    data: data,
                }).done(function(data) {
                    console.log(data);
                    if (data["success"]) {
                        $("#customer-name").val(data["message"][0]["name"]);
                        $("#customer-phone").val(data["message"][0]["number"]);

                        if (data["message"][0]["gender"] == "F")
                            $("#female").attr("checked", true);
                        if (data["message"][0]["gender"] == "M")
                            $("#male").attr("checked", true);

                        $("#customer-address").val(data["message"][0]["address"]);
                        $("#customer-id").val(data["message"][0]["cust_id"]);
                    }
                }).fail(function(error) {
                    console.log(error);
                })
            });

            $("#edit-customer-form").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "api/edit-customer",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    alert(data["message"]);
                }).fail(function(error) {
                    console.log(error);
                })
            });

            $(".delete-customer").on("click", function(e) {

                if (confirm("Are you sure you want to delete this customer data")) {
                    data = {
                        customer_id: $(this).attr("id")
                    }
                    $.ajax({
                        type: "POST",
                        url: "api/delete-customer",
                        data: data,
                    }).done(function(data) {
                        console.log(data);
                        alert(data["message"]);
                        window.location.reload();
                    }).fail(function(error) {
                        console.log(error);
                    })
                }
            });

            $(".btn-close").click(function() {
                window.location.reload();
            })

        });
    </script>
</body>

</html>