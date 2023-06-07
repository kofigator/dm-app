<?php
require_once('DatabaseMethods.php');

class Sale
{
    private $db;
    public function __construct()
    {
        $this->db = new DatabaseMethods();
    }

    public function getListOfItemsByTextInput($data, $user_id)
    {
        $query = "SELECT `item_id`, `item_name`, `unit_price` 
                    FROM items WHERE u_id = :ui AND item_name LIKE '%{$data}%'";
        return $this->db->getData($query, array(":ui" => $user_id));
    }

    public function getListOfItemsByID($itemID, $user_id)
    {
        $query = "SELECT `item_id`, `item_name`, `unit_price` 
                    FROM items WHERE u_id = :ui AND item_id = :it";
        return $this->db->getData($query, array("it" => $itemID, ":ui" => $user_id));
    }
}
