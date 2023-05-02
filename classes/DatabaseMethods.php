<?php

require_once('DatabaseConnect.php');

class DatabaseMethods
{
    private $conn;

    function __construct()
    {
        $this->conn = (new DatabaseConnect())->connect();
    }

    private function query($query, $params = array())
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        if (explode(' ', $query)[0] == 'SELECT' || explode(' ', $query)[0] == 'CALL') {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } elseif (explode(' ', $query)[0] == 'INSERT' || explode(' ', $query)[0] == 'UPDATE' || explode(' ', $query)[0] == 'DELETE') {
            return 1;
        }
    }

    /**
     * Function is used to fetch list data from DB
     * @param str mixed
     * @param params array()
     */
    public function getData($query, $params = array())
    {
        try {
            $result = $this->query($query, $params);
            if (!empty($result)) return $result;
            return 0;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Function is used to insert, update, and delete data in DB
     * @param str mixed
     * @param params array()
     */
    public function inputData($query, $params = array())
    {
        try {
            $result = $this->query($query, $params);
            if (!empty($result)) return $result;
            return 0;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
