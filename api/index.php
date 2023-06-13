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

    if ($_GET["url"] == "add-customer") {

        if (!isset($_POST["cust-name"]) || empty($_POST["cust-name"])) die(json_encode(array("success" => false, "message" => "Invalid customer name!")));
        if (!isset($_POST["cust-phone"]) || empty($_POST["cust-phone"])) die(json_encode(array("success" => false, "message" => "Invalid customer phone number!")));
        if (!isset($_POST["cust-gender"]) || empty($_POST["cust-gender"])) die(json_encode(array("success" => false, "message" => "Invalid customer gender!")));
        if (!isset($_POST["cust-address"]) || empty($_POST["cust-address"])) die(json_encode(array("success" => false, "message" => "Invalid customer address!")));

        $customerData = array(
            "name" => $_POST["cust-name"],
            "number" => $_POST["cust-phone"],
            "gender" => $_POST["cust-gender"],
            "address" => $_POST["cust-address"]
        );

        if ($Customer->addCustomer($customerData, $_SESSION["user"])) {
            die(json_encode(array("success" => true, "message" => "Customer added successfully!")));
        } else {
            die(json_encode(array("success" => false, "message" => "Failed to add customer data!")));
        }
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


    if ($_GET["url"] == "add-item") {

        if (!isset($_POST["item-name"]) || empty($_POST["item-name"])) die(json_encode(array("success" => false, "message" => "Invalid item-name!")));
        if (!isset($_POST["item-description"]) || empty($_POST["item-description"])) die(json_encode(array("success" => false, "message" => "Invalid item-description!")));
        if (!isset($_POST["item-unitprice"]) || empty($_POST["item-unitprice"])) die(json_encode(array("success" => false, "message" => "Invalid item-unitprice!")));
        if (!isset($_POST["item-quantity"]) || empty($_POST["item-quantity"])) die(json_encode(array("success" => false, "message" => "Invalid item-quantity!")));

        $itemData = array(
            "item_name" => $_POST["item-name"],
            "description" => $_POST["item-description"],
            "unit_price" => $_POST["item-unitprice"],
            "quantity" => $_POST["item-quantity"]
        );

        if ($Inventory->addItem($itemData, $_SESSION["user"])) {
            die(json_encode(array("success" => true, "message" => "Item added successfully!")));
        } else {
            die(json_encode(array("success" => false, "message" => "Failed to add item data!")));
        }
    }

    if ($_GET["url"] == "edit-item") {
        if (!isset($_POST["itm-id"])) die(json_encode(array("success" => false, "message" => "Invalid item-id!")));
        if (empty($_POST["itm-id"])) die(json_encode(array("success" => false, "message" => "item-id required!")));

        if (!isset($_POST["itm-name"])) die(json_encode(array("success" => false, "message" => "Invalid item-name!")));
        if (empty($_POST["itm-name"])) die(json_encode(array("success" => false, "message" => "item-name required!")));

        if (!isset($_POST["itm-description"])) die(json_encode(array("success" => false, "message" => "Invalid item-description!")));
        if (empty($_POST["itm-description"])) die(json_encode(array("success" => false, "message" => "itm-description required!")));

        if (!isset($_POST["itm-unitprice"])) die(json_encode(array("success" => false, "message" => "Invalid item-unitprice!")));
        if (empty($_POST["itm-unitprice"])) die(json_encode(array("success" => false, "message" => "itm-unitprice required!")));

        if (!isset($_POST["itm-quantity"])) die(json_encode(array("success" => false, "message" => "Invalid item-quantity!")));
        if (empty($_POST["itm-quantity"])) die(json_encode(array("success" => false, "message" => "item-quantity required!")));

        if ($Inventory->updateItem($_POST, $_SESSION["user"]))
            die(json_encode(array("success" => true, "message" => "Item data updated!")));
        die(json_encode(array("success" => false, "message" => "Failed to update item data!")));
    }

    if ($_GET["url"] == "fetch-item-data") {
        if (!isset($_POST["item_id"])) die(json_encode(array("success" => false, "message" => "Invalid item id!")));
        if (empty($_POST["item_id"])) die(json_encode(array("success" => false, "message" => "item id required!")));

        $data = $Inventory->getOneItem($_POST["item_id"], $_SESSION["user"]);
        if (!empty($data)) die(json_encode(array("success" => true, "message" => $data)));
        die(json_encode(array("success" => false, "message" => "Failed to retrieve item data!")));
    }

    if ($_GET["url"] == "delete-item") {
        if (!isset($_POST["item_id"])) die(json_encode(array("success" => false, "message" => "Invalid item id!")));
        if (empty($_POST["item_id"])) die(json_encode(array("success" => false, "message" => "item id required!")));

        if ($Inventory->deleteitem($_POST["item_id"], $_SESSION["user"]))
            die(json_encode(array("success" => true, "message" => "Item successfully removed!")));
        die(json_encode(array("success" => false, "message" => "Failed to removed item!")));
    }

    //POS
    if ($_GET["url"] == "fetch-item-list") {
        $data = $Sale->getListOfItemsByTextInput($_POST["_data"], $_SESSION["user"]);
        if (!empty($data)) die(json_encode(array("success" => true, "message" => $data)));
        die(json_encode(array("success" => false, "message" => "No match found!")));
    }
    if ($_GET["url"] == "fetch-item-for-purchase") {
        $data = $Sale->getListOfItemsByID($_POST["_data"], $_SESSION["user"]);
        if (!empty($data)) die(json_encode(array("success" => true, "message" => $data)));
        die(json_encode(array("success" => false, "message" => "No match found!")));
    }

    //Selling products
    if ($_GET["url"] == "sell-products") {
        if (!isset($_POST["customer-list"]) || empty($_POST["customer-list"]))
            die(json_encode(array("success" => false, "message" => "Customer is required!")));
        if (empty($_POST["payment-method"]) || empty($_POST["payment-method"]))
            die(json_encode(array("success" => false, "message" => "Payment method is required!")));
        if (empty($_POST["customer-deposit"]) || empty($_POST["customer-deposit"]))
            die(json_encode(array("success" => false, "message" => "Deposit amount is required!")));
        if (empty($_POST["items"]) || empty($_POST["items"]))
            die(json_encode(array("success" => false, "message" => "Deposit amount is required!")));
        
        $data = $Sale->getListOfItemsByID($_POST["_data"], $_SESSION["user"]);
        if (!empty($data)) die(json_encode(array("success" => true, "message" => $data)));
        die(json_encode(array("success" => false, "message" => "No match found!")));
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
