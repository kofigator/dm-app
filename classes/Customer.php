<?php
require_once('DatabaseMethods.php');

class Customer
{
    private $db;
    public function __construct()
    {
        $this->db = new DatabaseMethods();
    }

    /**
     * 
     */
    public function addCustomer($customerData, int $userID)
    {
        $query = "INSERT INTO customers (name, number, gender, address) VALUES (:nm, :nb, :gd, :ad, :ui)";
        $param = array(
            ":nm" => $customerData["name"], ":nb" => $customerData["number"],
            ":gd" => $customerData["gender"], ":ad" => $customerData["address"],
            ":ui" => $userID
        );
        return $this->db->inputData($query, $param);
    }

    /**
     * 
     */
    public function updateCustomer($customerData, int $customerID, int $userID)
    {
        $query = "UPDATE customers SET `name` = :nm, `number` = :nb, gender = :gd, address = :ad 
                update_at = CURRENT_TIMESTAMP() WHERE cust_id = :ci AND u_id = :ui";
        $param = array(
            ":nm" => $customerData["name"], ":nb" => $customerData["number"],
            ":gd" => $customerData["gender"], ":ad" => $customerData["address"],
            ":ci" => $customerID, ":ui" => $userID
        );
        return $this->db->inputData($query, $param);
    }

    /**
     * @param int $customerID
     * @param int $userID
     * @return mixed
     */
    public function deleteCustomer(int $customerID, int $userID)
    {
        $query = "DELETE FROM customers WHERE cust_id = :ci AND u_id = :ui";
        $param = array(":ci" => $customerID, ":ui" => $userID);
        return $this->db->inputData($query, $param);
    }

    /**
     * @param int $customerID
     * @param int $userID
     * @return mixed
     */
    public function getOneCustomer(int $customerID, int $userID)
    {
        $query = "SELECT * FROM customers WHERE cust_id = :ci AND u_id = :ui";
        $param = array(":ci" => $customerID, ":ui" => $userID);
        return $this->db->getData($query, $param);
    }

    /**
     * @param int $userID - id of the user
     * @return mixed - returns either an array or 0
     */
    public function getAllCustomers(int $userID)
    {
        $query = "SELECT * FROM customers WHERE u_id = :ui ORDER BY added_at DESC";
        $param = array(":ui" => $userID);
        return $this->db->getData($query, $param);
    }
}
