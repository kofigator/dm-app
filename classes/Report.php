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
}
