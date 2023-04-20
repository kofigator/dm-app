<?php
require_once('DatabaseMethods.php');

class Inventory
{
    private $db;
    public function __construct()
    {
        $this->db = new DatabaseMethods();
    }
}
