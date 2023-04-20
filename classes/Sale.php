<?php
require_once('DatabaseMethods.php');

class Sale
{
    private $db;
    public function __construct()
    {
        $this->db = new DatabaseMethods();
    }
}
