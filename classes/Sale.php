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

    private function generateTransactionNumber($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $transactionNumber = '';

        $charactersLength = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $transactionNumber .= $characters[rand(0, $charactersLength - 1)];
        }

        return $transactionNumber;
    }

    private function transIdExists($transactionNumber)
    {
        $query = "SELECT * FROM transactions WHERE trans_num = :transId";
        return $this->db->getData($query, array(':transId' => $transactionNumber));
    }

    private function paymentIdExists($paymentNumber)
    {
        $query = "SELECT * FROM payments WHERE pay_num = :payId";
        return $this->db->getData($query, array(':payId' => $paymentNumber));
    }

    private function getItemQuantityByItemID($itemID, $userID)
    {
        $query = "SELECT quantity FROM items WHERE u_id = :u AND item_id = :i";
        return $this->db->getData($query, array(":u" => $userID, ":i" => $itemID));
    }

    private function updateItemQuantityByItemID($itemID, $userID, $qantity)
    {
        $availQuantity = $this->getItemQuantityByItemID($itemID, $userID)[0]["quantity"];
        $newQuantity = $availQuantity - $qantity;
        $query = "UPDATE items SET `quantity` = :q WHERE item_id = :i AND u_id = :u";
        $param = array(":i" => $itemID, ":u" => $userID, ":q" => $newQuantity);
        return $this->db->inputData($query, $param);
    }

    private function savePurchaseItems($data, $user_id)
    {
        while (true) {
            $transactionNumber = $this->generateTransactionNumber();
            if (!empty($this->transIdExists($transactionNumber))) continue;
            else break;
        }

        while (true) {
            $paymentNumber = $this->generateTransactionNumber();
            if (!empty($this->paymentIdExists($paymentNumber))) continue;
            else break;
        }

        $query = "INSERT INTO transactions (`trans_num`, `user_id`) VALUES (:transId, :userId)";
        $this->db->inputData($query, array(":transId" => $transactionNumber, ":userId" => $user_id));

        $totalAdded = 0;
        $items = $data["items"];
        $itemsArray = json_decode($items, true);

        foreach ($itemsArray as $item) {
            $query = "INSERT INTO `sales`(`item_id`, `trans_num`, `pay_num`, `cust_id`, `user_id`, `quantity`, `unit_price`) 
                    VALUES(:ii, :ti, :pn, :ci, :ui, :qt, :up)";
            $done = $this->db->inputData($query, array(
                ":ii" => $item["id"],
                ":ti" => $transactionNumber,
                ":pn" => $paymentNumber,
                ":ci" => $data["customer-list"],
                ":ui" => $user_id,
                ":qt" => $item["quantity"],
                ":up" => $item["unit_price"]
            ));

            if ($done) {
                $this->updateItemQuantityByItemID($item["id"], $user_id, $item["quantity"]);
                $totalAdded += 1;
            }
        }

        if ($totalAdded) return $paymentNumber;
        return 0;
    }

    /*SELECT s.* FROM sales AS s, items AS i, customers AS c, transactions AS t, payments AS p, users AS u WHERE s.item_id = i.item_id AND s.cust_id = c.cust_id AND s.user_id = u.phone_number AND c.u_id = u.phone_number AND t.user_id = u.phone_number AND i.u_id = u.phone_number AND p.user_id = u.phone_number AND u.phone_number = '0541236547' AND s.trans_num = t.trans_num GROUP BY s.trans_num; */
    private function savePurchasePayment($data, $user_id, $paymentNumber)
    {
        $query = "INSERT INTO `payments`(`user_id`, `cust_id`, `pay_num`, `pay_type`, `amount`, `mode`) 
                    VALUES(:ui, :ci, :pn, :pt, :am, :md)";
        return $this->db->inputData($query, array(
            ":ui" => $user_id,
            ":ci" => $data["customer-list"],
            ":pn" => $paymentNumber,
            ":pt" => 'initial',
            ":am" => $data["customer-deposit"],
            ":md" => $data["payment-method"]
        ));
    }

    private function savePurchase($data, $user_id)
    {
        $paymentNumber = $this->savePurchaseItems($data, $user_id);
        if ($paymentNumber) {
            if ($this->savePurchasePayment($data, $user_id, $paymentNumber)) {
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

    public function settleDebts($userID, $data)
    {

        while (true) {
            $paymentNumber = $this->generateTransactionNumber();
            if (!empty($this->paymentIdExists($paymentNumber))) continue;
            else break;
        }

        $query = "INSERT INTO payments (`user_id`, `cust_id`, `pay_num`, `pay_type`, `amount`, `mode`) 
                VALUES(:ui, :ci, :pn, :pt, :am, :md)";

        return $this->db->inputData($query, array(
            ":ui" => $userID,
            ":ci" => $data["customer-id"],
            ":pn" => $paymentNumber,
            ":pt" => 'continual',
            ":am" => $data["customer-deposit"],
            ":md" => $data["payment-method"]
        ));
    }

    function fetchAmountCustomerOwes($userID)
    {
        $query = "SELECT c.cust_id, c.name, c.city, (s.total_sum - p.amount_sum) AS amount_owing FROM customers AS c
        JOIN (SELECT cust_id, SUM(total) AS total_sum FROM sales GROUP BY cust_id) AS s ON c.cust_id = s.cust_id
        JOIN (SELECT cust_id, SUM(amount) AS amount_sum FROM payments GROUP BY cust_id) AS p ON c.cust_id = p.cust_id
        JOIN users AS u ON c.u_id = u.phone_number WHERE u.phone_number = :ui ORDER BY amount_owing DESC";

        return $this->db->inputData($query, array(":ui" => $userID));
    }
}
