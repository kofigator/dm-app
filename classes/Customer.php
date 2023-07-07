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
        $query = "INSERT INTO customers (`name`, `number`, `gender`, `city`, `address`, u_id) 
                    VALUES (:nm, :nb, :gd, :ct, :ad, :ui)";
        $param = array(
            ":nm" => $customerData["name"], ":nb" => $customerData["number"],
            ":gd" => $customerData["gender"], ":ct" => $customerData["city"],
            ":ad" => $customerData["address"], ":ui" => $userID
        );
        return $this->db->inputData($query, $param);
    }

    /**
     * 
     */
    public function updateCustomer($customerData, $userID)
    {
        $query = "UPDATE customers SET `name` = :nm, `number` = :nb, gender = :gd, `city` = :ct, `address` = :ad 
                WHERE cust_id = :ci AND u_id = :ui";
        $param = array(
            ":nm" => $customerData["customer-name"], ":nb" => $customerData["customer-phone"],
            ":gd" => $customerData["customer-gender"], ":ct" => $customerData["customer-city"],
            ":ad" => $customerData["customer-address"], ":ci" => $customerData["customer-id"], ":ui" => $userID
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
        $query = "UPDATE customers SET `archive` = 1 WHERE cust_id = :ci AND u_id = :ui";
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
        $query = "SELECT `cust_id`, `city`, `gender`, `name`, `number`, `address` 
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
        $query = "SELECT * FROM customers WHERE u_id = :ui AND `archive` = 0 ORDER BY added_at DESC";
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


    /*
    REPORTS
    */

    public function getCustomersCityGrouped($userID)
    {
        $query = "SELECT city FROM customers WHERE u_id = :ui GROUP BY city";
        $param = array(":ui" => $userID);
        return $this->db->getData($query, $param);
    }

    public function getCustomerReports($data, $userID)
    {
        $query_join = "";
        if (!empty($data["reportCity"])) $query_join .= " AND city = '{$data["reportCity"]}'";
        if (!empty($data["reportGender"])) $query_join .= " AND gender = '{$data["reportGender"]}'";
        if (!empty($data["startDate"]) && !empty($data["endDate"])) $query_join .= " AND DATE(added_at) BETWEEN '{$data["startDate"]}' AND '{$data["endDate"]}'";
        $query = "SELECT * FROM customers WHERE `archive` = 0 AND u_id = '{$userID}' $query_join ORDER BY added_at DESC";
        $_SESSION["print_reports"] = array("name" => "customers", "query" => $query);
        return $this->db->getData($query);
    }
}
