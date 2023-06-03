<?php
include 'includes/autoloader.inc.php';

class ProductList
{
    private $db;
    private $products;

    public function __construct()
    {
        $this->db = new Db();
        $this->fetchProducts();
    }

    private function fetchProducts()
    {
        $this->products = $this->db->getProducts();
    }

    public function getProducts()
    {
        return $this->products;
    }
}
