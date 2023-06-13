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

    public function sellProducts($data, $user_id)
    {
        /*
        INSERT INTO `customers`(`cust_id`, `u_id`, `name`, `number`, `gender`, `address`) 
VALUES (1, 1, 'Non customer', '0123456789', 'none', 'none')
        */
        $totalAdded = 0;
        foreach ($data["items"] as $item) {
            $query = "INSERT INTO `sales`(`item_id`, `cust_id`, `user_id`, `quantity`, `unit_price`) 
                    VALUES(:ii, :ci, :ui, :qt, :up)";
            return $item;
            $totalAdded += $this->db->inputData($query, array(
                ":ii" => $item["id"],
                ":ii" => $data["customer-list"],
                ":ui" => $user_id,
                ":qt" => $item["quantity"],
                ":up" => $item["unit_price"]
            ));
        }
        return $totalAdded;
    }
}
