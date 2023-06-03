<?php

    abstract class Products extends Db 
{
    protected $sku;
    protected $name;
    protected $price;

    protected $productType;

    public function __construct($sku, $name, $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    abstract public function saveToDatabase();


}