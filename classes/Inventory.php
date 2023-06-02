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
        $query = "INSERT INTO items (item_name, description, unit_price, quantity, u_id) VALUES (:nm, :nb, :gd, :ad, :ui)";
        $param = array(
            ":nm" => $itemData["item_name"], ":nb" => $itemData["description"],
            ":gd" => $itemData["unit_price"], ":ad" => $itemData["quantity"],
            ":ui" => $userID
        );
        return $this->db->inputData($query, $param);
    }
    
    /**
     * 
     */
    public function updateItem($itemData, $userID)
    {
        $query = "UPDATE items SET `item_name` = :nm, `description` = :nb, unit_price = :gd, `quantity` = :ad 
                WHERE cust_id = :ci AND u_id = :ui";
        $param = array(
            ":nm" => $itemData["itm-name"], ":nb" => $itemData["itm-description"],
            ":gd" => $itemData["itm-unitprice"], ":ad" => $itemData["itm-quantity"],
            ":ci" => $itemData["itm-id"], ":ui" => $userID
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
        $query = "DELETE FROM items WHERE item_id = :ci AND u_id = :ui";
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
        $query = "SELECT `item_id`, `item_name`, `description`, `unit_price`, `quantity` 
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
        $query = "SELECT * FROM items WHERE u_id = :ui ORDER BY added_at DESC";
        return $this->db->getData($query, array(":ui" => $userID));
    }
}
