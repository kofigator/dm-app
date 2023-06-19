<?php
require_once('DatabaseMethods.php');
require_once('Customer.php');

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

    private function savePurchaseItems($data, $user_id)
    {
        $randomString = $this->generateRandomStrings();

        $transaction_exist = $this->transIdExists($randomString);

        if (empty($transaction_exist)) {
            $query = "INSERT INTO transactions (`trans_num`, `user_id`) VALUES (:transId, :userId)";
            $this->db->inputData($query, array(
                ":transId" => $randomString,
                ":userId" => $user_id
            ));
        } else {
            // Handle the case when the random string already exists
            // You can generate a new random string or handle it in some other way
            return;
        }

        $trans_id = $randomString; // Use the generated random string as trans_id

        $totalAdded = 0;
        $items = $data["items"];
        $itemsArray = json_decode($items, true);
        foreach ($itemsArray as $item) {
            $query = "INSERT INTO `sales`(`item_id`, `trans_id`, `cust_id`, `user_id`, `quantity`, `unit_price`) 
                    VALUES(:ii, :ti, :ci, :ui, :qt, :up)";
            $totalAdded += $this->db->inputData($query, array(
                ":ii" => $item["id"],
                ":ti" => $trans_id,
                ":ci" => $data["customer-list"],
                ":ui" => $user_id,
                ":qt" => $item["quantity"],
                ":up" => $item["unit_price"]
            ));
        }

        return $totalAdded;
    }


    private function savePurchasePayment($data, $user_id)
    {
        $query = "INSERT INTO `payments`(`user_id`, `cust_id`, `amount`, `mode`) VALUES(:ui, :ci, :am, :md)";
        return $this->db->inputData($query, array(
            ":ui" => $user_id,
            ":ci" => $data["customer-list"],
            ":am" => $data["customer-deposit"],
            ":md" => $data["payment-method"]
        ));
    }

    private function generateRandomStrings($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return $randomString;
    }

    private function transIdExists($randomString)
    {
        $query = "SELECT * FROM transactions WHERE trans_num = :transId";
        return $this->db->getData($query, array(':transId' => $randomString));
    }

    
    

    private function savePurchase($data, $user_id)
    {
        if ($this->savePurchaseItems($data, $user_id)) {
            if ($this->savePurchasePayment($data, $user_id)) {
                return array("success" => true, "message" => "Purchase successfull!");
            }
            return array("success" => false, "message" => "Failed to record payment!");
        }
        return array("success" => false, "message" => "Failed to record items!");
    }

    public function sellProducts($data, $user_id)
    {
        if ($data["buyer-type"] == "option1") return $this->savePurchase($data, $user_id);
        if ($data["buyer-type"] == "option2") {
            $Cust = new Customer();
            $buyer_data = array(
                "name" => $data["buyer-name"],
                "number" => $data["buyer-phone"],
                "gender" => $data["buyer-gender"],
                "address" => $data["buyer-address"],
                "city" => $data["buyer-city"]
            );

            $customer_exist = $Cust->getCustomerByPhoneNumber($data["buyer-phone"], $user_id);

            if (!empty($customer_exist)) {
                return array("success" => false, "message" => "A customer with this phone number already exists");
            }

            if ($Cust->addCustomer($buyer_data, $user_id)) {
                $custID = $Cust->getCustomerByPhoneNumber($data["buyer-phone"], $user_id);
                $data["customer-list"] = $custID[0]["cust_id"];
                return $this->savePurchase($data, $user_id);
            } else {
                return array("success" => false, "message" => "Failed to add buyer data!");
            }
        }
        return array("success" => false, "message" => "Unable to process purchase! " . $data["buyer-type"]);
    }
}
