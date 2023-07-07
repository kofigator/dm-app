<?php
require_once('DatabaseMethods.php');

class Inventory
{
    private $db;
    public function __construct()
    {
        $this->db = new DatabaseMethods();
    }

    public function addItem($itemData, $userID)
    {
        $query = "INSERT INTO items (item_name, description, cost_price, unit_price, quantity, u_id) 
                VALUES (:nm, :nb, :cp, :gd, :ad, :ui)";
        $param = array(
            ":nm" => $itemData["item_name"], ":nb" => $itemData["description"],
            ":cp" => $itemData["cost_price"], ":gd" => $itemData["unit_price"],
            ":ad" => $itemData["quantity"], ":ui" => $userID
        );
        return $this->db->inputData($query, $param);
    }

    /**
     * @param int $itemID
     * @param int $userID
     * @return mixed
     */
    public function updateItem($itemData, $userID)
    {
        $query = "UPDATE items SET `item_name` = :nm, `description` = :nb, cost_price = :cp, unit_price = :gd, `quantity` = :ad 
                WHERE item_id = :ci AND u_id = :ui";
        $param = array(
            ":nm" => $itemData["itm-name"], ":nb" => $itemData["itm-description"],
            ":cp" => $itemData["itm-costprice"], ":gd" => $itemData["itm-unitprice"],
            ":ad" => $itemData["itm-quantity"], ":ci" => $itemData["itm-id"], ":ui" => $userID
        );
        return $this->db->inputData($query, $param);
    }

    public function updateQuantity($itemData, $userID)
    {
        $query = "UPDATE items SET  `quantity` = :ad 
                WHERE item_name = :ci AND u_id = :ui";
        $param = array(
            ":ad" => $itemData["item-quantity"], ":ci" => $itemData["item-name"], ":ui" => $userID
        );
        return $this->db->inputData($query, $param);
    }

    /**
     * @param int $itemID
     * @param int $userID
     * @return mixed
     */
    public function deleteItem($itemID, $userID)
    {
        $query = "UPDATE items SET  `archive` = 1  WHERE item_id = :ci AND u_id = :ui";
        $param = array(":ci" => $itemID, ":ui" => $userID);
        return $this->db->inputData($query, $param);
    }

    /**
     * @param int $itemID
     * @param int $userID
     * @return mixed
     */
    public function getOneItem($itemID, $userID)
    {
        $query = "SELECT `item_id`, `item_name`, `description`, `cost_price`, `unit_price`, `quantity` 
                    FROM items WHERE item_id = :ci AND u_id = :ui";
        $param = array(":ci" => $itemID, ":ui" => $userID);
        return $this->db->getData($query, $param);
    }

    /**
     * @param int $userID - id of the user
     * @return mixed - returns either an array or 0
     */
    public function getAllItems($userID)
    {
        $query = "SELECT * FROM items WHERE u_id = :ui AND `archive` = 0 ORDER BY added_at DESC";
        $query2 = "SELECT item_id, SUM(quantity) AS total_quantity FROM sales WHERE u_id = :ui GROUP BY item_id";
        return $this->db->getData($query, array(":ui" => $userID));
        return $this->db->getData($query2, array(":ui" => $userID));
    }

    public function getInventoryDescription($userID)
    {
        $query = "SELECT description FROM items WHERE u_id = :ui GROUP BY description";
        $param = array(":ui" => $userID);
        return $this->db->getData($query, $param);
    }

    public function getItemsReports($data, $userID)
    {
        $query_join = "";
        if (!empty($data["startDate"]) && !empty($data["endDate"])) $query_join .= " AND DATE(added_at) BETWEEN '{$data["startDate"]}' AND '{$data["endDate"]}'";
        $query = "SELECT * FROM items WHERE `archive` = 0 AND u_id = '{$userID}' $query_join ORDER BY added_at DESC";
        $_SESSION["print_reports"] = array("name" => "items", "query" => $query);
        return $this->db->getData($query);
    }

    public function getTotalQuantityForEachItemSold($userID, $productID)
    {
        $query = "SELECT SUM(quantity) AS totalQuantity FROM sales WHERE product_id = :pid AND u_id = :ui";
        $param = array(":pid" => $productID, ":ui" => $userID);
        return $this->db->getData($query, $param);
    }

}
