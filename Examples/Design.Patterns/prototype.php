<?php

class CD
{
    public $band = '';
    public $title = '';
    public $trackList = array();
    
    public function __construct($id)
    {
        $handle = mysql_connect('localhost', 'user', 'pass');
        mysql_select_db('CD', $handle);
        $query   = "select band, title, from CDs where id={$id}";
        $results = mysql_query($query, $handle);
        if ($row = mysql_fetch_assoc($results)) {
            $this->band  = $row['band'];
            $this->title = $row['title'];
        }
    }
    public function buy()
    {
        //cd buying magic here
        var_dump($this);
    }
}

class MixtapeCD extends CD
{
    public function __clone()
    {
        $this->title = 'Mixtape';
    }
}

$externalPurchaseInfoBandID = 12;
$bandMixProto               = new MixtapeCD($externalPurchaseInfoBandID);
$externalPurchaseInfo       = array();
$externalPurchaseInfo[]     = array(
    'brrr',
    'goodbye'
);
$externalPurchaseInfo[]     = array(
    'what it means',
    'brrr'
);
foreach ($externalPurchaseInfo as $mixed) {
    $cd            = clone $bandMixProto;
    $cd->trackList = $mixed;
    $cd->buy();
}
