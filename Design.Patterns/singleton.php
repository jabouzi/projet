<?php

class InventoryConnection
{
    protected static $_instance = NULL;
    protected $_handle = NULL;
    public static function getInstance()
    {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    protected function __construct()
    {
        $this->_handle = mysql_connect('localhost', 'user', 'pass');
        mysql_select_db('CD', $this->_handle);
    }
    public function updateQuantity($band, $title, $number)
    {
        $query = "update CDS set amount=amount+" . intval($number);
        $query .= " where band='" . mysql_real_escape_string($band) . "'";
        $query .= " and title='" . mysql_real_escape_string($title) . "'";
        mysql_query($query, $this->_handle);
    }
}

class CD
{
    protected $_title = '';
    protected $_band = '';
    public function __construct($title, $band)
    {
        $this->_title = $title;
        $this->_band  = $band;
    }
    public function buy()
    {
        $inventory = InventoryConnection::getInstance();
        $inventory->updateQuantity($this->_band, $this->_title, -1);
    }
}

$boughtCDs   = array();
$boughtCDs[] = array(
    'band' => 'Never Again',
    'Waste of a Rib'
);
$boughtCDs[] = array(
    'band' => 'Therapee',
    'Long Road'
);
foreach ($boughtCDs as $boughtCD) {
    $cd = new CD($boughtCD['title'], $boughtCD['band']);
    $cd->buy();
}
