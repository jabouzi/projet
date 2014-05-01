<?php

class CD
{
    public $band;
    public $title;
    public $price;
    public function __construct($band, $title, $price)
    {
        $this->band  = $band;
        $this->title = $title;
        $this->price = $price;
    }
    public function buy()
    {
        //stub
    }
    public function acceptVisitor($visitor)
    {
        $visitor->visitCD($this);
    }
}

class CDVisitorLogPurchase
{
    public function visitCD($cd)
    {
        $logline = "{$cd->title} by {$cd->band} was purchased for {$cd->price} ";
        $logline .= "at " . sdate('r') . "\n";
        file_put_contents('/logs/purchases.log', $logline, FILE_APPEND);
    }
}

$externalBand  = 'Never Again';
$externalTitle = 'Waste of a Rib';
$externalPrice = 9.99;
$cd            = new CD($externalBand, $externalTitle, $externalPrice);
$cd->buy();
$cd->acceptVisitor(new CDVisitorLogPurchase());

class CDVisitorPopulateDiscountList
{
    public function visitCD($cd)
    {
        if ($cd->price < 10) {
            $this->_populateDiscountList($cd);
        }
    }
    protected function _populateDiscountList($cd)
    {
        //stub connects to sqlite and logs
    }
}

$cd = new CD($externalBand, $externalTitle, $externalPrice);
$cd->buy();
$cd->acceptVisitor(new CDVisitorLogPurchase());
$cd->acceptVisitor(new CDVisitorPopulateDiscountList());
