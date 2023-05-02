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
		if (!isset($_POST["phone-num"])) die(json_encode(array("success" => false, "message" => "Phone number is required")));
		if (!isset($_POST["password"])) die(json_encode(array("success" => false, "message" => "Password number is required")));

		$firstName = $dc->validateText($_POST["first-name"]);
		$lastName = $dc->validateText($_POST["last-name"]);
		$emailAddr = $dc->validateEmail($_POST["email-nddr"]);
		$phoneNum = $dc->validateNumber($_POST["phone-num"]);
		$gender = $dc->validateText($_POST["gender"]);
		$password = $dc->validatePassword($_POST["password"]);

		$result = $User->registerUser($firstName, $lastName, $gender, $emailAddr, $phoneNum, $password);

		if (!$result) die(json_encode(array("success" => false, "message" => "User registration failed!")));

		die(json_encode(array("success" => true, "message" => "Registration successful!")));
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
