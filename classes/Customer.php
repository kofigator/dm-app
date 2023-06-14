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
    public function addCustomer($customerData, $userID)
    {
        $query = "INSERT INTO customers (name, number, gender, address, u_id) VALUES (:nm, :nb, :gd, :ad, :ui)";
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
    public function updateCustomer($customerData, $userID)
    {
        $query = "UPDATE customers SET `name` = :nm, `number` = :nb, gender = :gd, `address` = :ad 
                WHERE cust_id = :ci AND u_id = :ui";
        $param = array(
            ":nm" => $customerData["customer-name"], ":nb" => $customerData["customer-phone"],
            ":gd" => $customerData["customer-gender"], ":ad" => $customerData["customer-address"],
            ":ci" => $customerData["customer-id"], ":ui" => $userID
        );
        return $this->db->inputData($query, $param);
    }

    /**
     * @param int $customerID
     * @param int $userID
     * @return mixed
     */
    public function deleteCustomer($customerID, $userID)
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
    public function getOneCustomer($customerID, $userID)
    {
        $query = "SELECT `cust_id`, `gender`, `name`, `number`, `address` 
                    FROM customers WHERE cust_id = :ci AND u_id = :ui";
        $param = array(":ci" => $customerID, ":ui" => $userID);
        return $this->db->getData($query, $param);
    }

    /**
     * @param int $userID - id of the user
     * @return mixed - returns either an array or 0
     */
    public function getAllCustomers($userID)
    {
        $query = "SELECT * FROM customers WHERE u_id = :ui ORDER BY added_at DESC";
        return $this->db->getData($query, array(":ui" => $userID));
    }

    /**
     * @param int $customerID
     * @param int $userID
     * @return mixed
     */
    public function getCustomerByPhoneNumber($phoneNumber, $userID)
    {
        $query = "SELECT * FROM `customers` WHERE `number` = :pn AND `u_id` = :ui";
        $param = array(":pn" => $phoneNumber, ":ui" => $userID);
        return $this->db->getData($query, $param);
    }
}
