<?php
require_once('DatabaseMethods.php');

class Report
{
    private $db;
    public function __construct()
    {
        $this->db = new DatabaseMethods();
    }

    public function getReport($report)
    {
        return $this->db->getData($report["query"]);
    }

    /*
    REPORTS
    */

    /**
     * Customers reports
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
        $query = "SELECT * FROM customers WHERE u_id = '{$userID}' $query_join ORDER BY added_at DESC";
        $_SESSION["print_reports"] = array("name" => "customers", "query" => $query);
        return $this->db->getData($query);
    }


    /**
     * Sales reports
     */
    public function generateSaleReports($data, $userID)
    {
        $query_join = "";
        if (!empty($data["reportCity"])) $query_join .= " AND city = '{$data["reportCity"]}'";
        if (!empty($data["reportGender"])) $query_join .= " AND gender = '{$data["reportGender"]}'";
        if (!empty($data["startDate"]) && !empty($data["endDate"])) $query_join .= " AND DATE(added_at) BETWEEN '{$data["startDate"]}' AND '{$data["endDate"]}'";
        $query = "SELECT * FROM sales AS s, items AS i WHERE u_id = '{$userID}' $query_join ORDER BY added_at DESC";
        $_SESSION["print_reports"] = array("name" => "customers", "query" => $query);
        return $this->db->getData($query);
    }

    /**
     * Inventory reports
     */
    public function generateInventotyReports($data, $userID)
    {
        $query_join = "";
        if (!empty($data["reportCity"])) $query_join .= " AND city = '{$data["reportCity"]}'";
        if (!empty($data["reportGender"])) $query_join .= " AND gender = '{$data["reportGender"]}'";
        if (!empty($data["startDate"]) && !empty($data["endDate"])) $query_join .= " AND DATE(added_at) BETWEEN '{$data["startDate"]}' AND '{$data["endDate"]}'";
        $query = "SELECT * FROM items WHERE u_id = '{$userID}' $query_join ORDER BY added_at DESC";
        $_SESSION["print_reports"] = array("name" => "customers", "query" => $query);
        return $this->db->getData($query);
    }
}
