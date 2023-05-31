<?php
session_start();
/*
* Designed and programmed by
* @Author: Francis A. Anlimah
*/

require_once('../classes/User.php');
require_once('../classes/Customer.php');
require_once('../classes/Inventory.php');
require_once('../classes/Report.php');
require_once('../classes/Sale.php');
require_once('../classes/DataController.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$User = new User();
$Customer = new Customer();
$Inventory = new Inventory();
$Report = new Report();
$Sale = new Sale();
$dc = new DataController();

$data = [];
//$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
}

// All POST request will be sent here
elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_GET["url"] == "login") {
        if (!isset($_POST["email"])) die(json_encode(array("success" => false, "message" => "Email is required!")));
        if (!isset($_POST["password"])) die(json_encode(array("success" => false, "message" => "Password is required")));

        $email = $dc->validateEmail($_POST["email"]);
        $password = $dc->validatePassword($_POST["password"]);

        $result = $User->verifyUserLogin($email, $password);

        if (!$result) die(json_encode(array("success" => false, "message" => "Invalid email or password!")));

        $_SESSION['user'] = $result["id"];
        $_SESSION['appLogin'] = true;

        die(json_encode(array("success" => true, "message" => "Login successful")));
    }

    if ($_GET["url"] == "register") {

        if (!isset($_POST["first-name"])) die(json_encode(array("success" => false, "message" => "First name is required!")));
        if (!isset($_POST["last-name"])) die(json_encode(array("success" => false, "message" => "Last name is required")));
        if (!isset($_POST["gender"])) die(json_encode(array("success" => false, "message" => "Gender is required")));
        if (!isset($_POST["email-addr"])) die(json_encode(array("success" => false, "message" => "Email address is required")));
        if (!isset($_POST["phone"])) die(json_encode(array("success" => false, "message" => "Phone number is required")));
        if (!isset($_POST["password"])) die(json_encode(array("success" => false, "message" => "Password number is required")));

        $Name = $dc->validateText($_POST["first-name"]);
        $lastName = $dc->validateText($_POST["last-name"]);
        $emailAddr = $dc->validateEmail($_POST["email-addr"]);
        $phoneNum = $dc->validateNumber($_POST["phone"]);
        $gender = $dc->validateText($_POST["gender"]);
        $password = $dc->validatePassword($_POST["password"]);

        $result = $User->registerUser($Name, $lastName, $gender, $emailAddr, $phoneNum, $password);

        if (!$result) die(json_encode(array("success" => false, "message" => "User registration failed!")));

        die(json_encode(array("success" => true, "message" => "Registration successful!")));
    }

    //Adding New Customer
    if ($_GET["url"] == "add_customer") {

        if (!isset($_POST["name"])) die(json_encode(array("success" => false, "message" => "Name is required!")));
        if (!isset($_POST["phone"])) die(json_encode(array("success" => false, "message" => "Phone number is required")));
        if (!isset($_POST["gender"])) die(json_encode(array("success" => false, "message" => "Gender is required")));
        if (!isset($_POST["address"])) die(json_encode(array("success" => false, "message" => "Name is required!")));


        $Name = $dc->validateText($_POST["name"]);
        $PhoneNum = $dc->validateNumber($_POST["phone"]);
        $Gender = $dc->validateText($_POST["gender"]);
        $Address = $dc->validateText($_POST["address"]);

        $result = $User->addCustomer($Name, $PhoneNum, $Gender, $Address);

        if ($result) die(json_encode(array("success" => false, "message" => "Registration successful!")));

        die(json_encode(array("success" => true, "message" => "Adding Customer Failed!")));
    }

    //Adding an Item
    if ($_GET["url"] == "add_item") {

        if (!isset($_POST["item_name"])) die(json_encode(array("success" => false, "message" => "Item-name is required!")));
        if (!isset($_POST["description"])) die(json_encode(array("success" => false, "message" => "Description is required")));
        if (!isset($_POST["unit_price"])) die(json_encode(array("success" => false, "message" => "Unit-price is required")));
        if (!isset($_POST["quantity"])) die(json_encode(array("success" => false, "message" => "Quantity address is required")));

        $Name = $dc->validateText($_POST["item_name"]);
        $Description = $dc->validateText($_POST["description"]);
        $unit_Price = $dc->validateNumber($_POST["unit_price"]);
        $Quantity = $dc->validateNumber($_POST["quantity"]);

        $result = $User->addItem($Name, $Description, $unit_Price, $Quantity);

        if ($result) die(json_encode(array("success" => false, "message" => "User registration failed!")));

        die(json_encode(array("success" => true, "message" => "Registration successful!")));
    }

    if ($_GET["url"] == "edit-customer") {
        if (!isset($_POST["customer-id"])) die(json_encode(array("success" => false, "message" => "Invalid customer id!")));
        if (empty($_POST["customer-id"])) die(json_encode(array("success" => false, "message" => "Customer id required!")));

        if (!isset($_POST["customer-name"])) die(json_encode(array("success" => false, "message" => "Invalid customer name!")));
        if (empty($_POST["customer-name"])) die(json_encode(array("success" => false, "message" => "Customer name required!")));

        if (!isset($_POST["customer-phone"])) die(json_encode(array("success" => false, "message" => "Invalid customer phone number!")));
        if (empty($_POST["customer-phone"])) die(json_encode(array("success" => false, "message" => "Customer phone number required!")));

        if (!isset($_POST["customer-gender"])) die(json_encode(array("success" => false, "message" => "Invalid customer gender!")));
        if (empty($_POST["customer-gender"])) die(json_encode(array("success" => false, "message" => "Customer gender required!")));

        if (!isset($_POST["customer-address"])) die(json_encode(array("success" => false, "message" => "Invalid customer address!")));
        if (empty($_POST["customer-address"])) die(json_encode(array("success" => false, "message" => "Customer address required!")));

        if ($Customer->updateCustomer($_POST, $_SESSION["user"]))
            die(json_encode(array("success" => true, "message" => "Customer data updated!")));
        die(json_encode(array("success" => false, "message" => "Failed to update customer data!")));
    }

    if ($_GET["url"] == "delete-customer") {
        if (!isset($_POST["customer_id"])) die(json_encode(array("success" => false, "message" => "Invalid customer id!")));
        if (empty($_POST["customer_id"])) die(json_encode(array("success" => false, "message" => "Customer id required!")));

        if ($Customer->deleteCustomer($_POST["customer_id"], $_SESSION["user"]))
            die(json_encode(array("success" => true, "message" => "Customer successfully removed!")));
        die(json_encode(array("success" => false, "message" => "Failed to removed customer!")));
    }

    if ($_GET["url"] == "fetch-customer-data") {
        if (!isset($_POST["customer_id"])) die(json_encode(array("success" => false, "message" => "Invalid customer id!")));
        if (empty($_POST["customer_id"])) die(json_encode(array("success" => false, "message" => "Customer id required!")));

        $data = $Customer->getOneCustomer($_POST["customer_id"], $_SESSION["user"]);
        if (!empty($data)) die(json_encode(array("success" => true, "message" => $data)));
        die(json_encode(array("success" => false, "message" => "Failed to retrieve customer data!")));
    }
}



// PUT/UPDATE
else if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    parse_str(file_get_contents("php://input"), $_PUT);
}

// DELETE Requests
else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    parse_str(file_get_contents("php://input"), $_DELETE);
} else {
    http_response_code(405);
}
