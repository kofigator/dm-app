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
                  FROM items WHERE u_id = :ui AND item_name LIKE :data";
        $params = array(":ui" => $user_id, ":data" => "%{$data}%");
        return $this->db->getData($query, $params);
    }

    public function getListOfItemsByID($itemID, $user_id)
    {
        $query = "SELECT `item_id`, `item_name`, `unit_price` 
                  FROM items WHERE u_id = :ui AND item_id = :it";
        $params = array(":ui" => $user_id, ":it" => $itemID);
        return $this->db->getData($query, $params);
    }

    public function sellProducts($data, $user_id)
    {
        /*
        INSERT INTO `customers`(`cust_id`, `u_id`, `name`, `number`, `gender`, `address`) 
        VALUES (1, 1, 'Non customer', '0123456789', 'none', 'none')
        */
        $totalAdded = 0;
        
        if (isset($data["items"]) && is_array($data["items"])) {
            foreach ($data["items"] as $item) {
                $query = "INSERT INTO `sales` (`item_id`, `cust_id`, `user_id`, `quantity`, `unit_price`) 
                          VALUES(:ii, :ci, :ui, :qt, :up)";
                $params = array(
                    ":ii" => $item["id"],
                    ":ci" => $data["customer-list"],
                    ":ui" => $user_id,
                    ":qt" => $item["quantity"],
                    ":up" => $item["unit_price"]
                );
                $totalAdded += $this->db->inputData($query, $params);
            }
        }
        
        return $totalAdded;
    }
}
