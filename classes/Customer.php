<?php
require_once('DatabaseMethods.php');

class Customer
{
    private $db;
    public function __construct()
    {
        $this->db = new DatabaseMethods();
    }

    public function verifyUserLogin($email, $password)
    {
        $query = "SELECT `u_id`, `password` FROM `logins` WHERE `username` = :u";
        $params = array(":u" => $email);
        $result = $this->db->getData($query, $params);
        if (!$result) return $result;

        if (password_verify($password, $result[0]["password"])) {
            return array("id" => $result[0]["u_id"]);
        } else {
            return 0;
        }
    }

    public function registerUser($firstName, $lastName, $gender, $emailAddr, $phoneNum, $password)
    {
        $query = "INSERT INTO `users`(`fisrt_name`, `last_name`, `gender`, `email`, `phone_number`) VALUES(:f, :l, :g, :e, :p)";
        $params = array(":f" => $firstName, ":l" => $lastName, ":g" => $gender, ":e" => $emailAddr, ":p" => $phoneNum);
        $result = $this->db->inputData($query, $params);
        if (!$result) return $result;

        $hashedPassw = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `logins`(`u_id`, `username`, `password`) VALUES(:u, :e, :p)";
        $params = array(":u" => $phoneNum, ":e" => $emailAddr, ":p" => $hashedPassw);
        return $this->db->inputData($query, $params);
    }
}
