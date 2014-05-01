<?php

class CD
{
    public $title = '';
    public $band = '';
    public function __construct($title, $band)
    {
        $this->title = $title;
        $this->band  = $band;
    }
    public function getAsXML()
    {
        $doc   = new DomDocument();
        $root  = $doc->createElement('CD');
        $root  = $doc->appendChild($root);
        $title = $doc->createElement('TITLE', $this->title);
        $title = $root->appendChild($title);
        $band  = $doc->createElement('BAND', $this->band);
        $band  = $root->appendChild($band);
        return $doc->saveXML();
    }
}

$externalBand  = 'Never Again';
$externalTitle = 'Waste of a Rib';
$cd            = new CD($externalTitle, $externalBand);
print $cd->getAsXML();

class CDusesStrategy
{
    public $title = '';
    public $band = '';
    protected $_strategy;
    public function __construct($title, $band)
    {
        $this->title = $title;
        $this->band  = $band;
    }
    public function setStrategyContext($strategyObject)
    {
        $this->_strategy = $strategyObject;
    }
    public function get()
    {
        return $this->_strategy->get($this);
    }
}

class CDAsXMLStrategy
{
    public function get(CDusesStrategy $cd)
    {
        $doc   = new DomDocument();
        $root  = $doc->createElement('CD');
        $root  = $doc->appendChild($root);
        $title = $doc->createElement('TITLE', $cd->title);
        $title = $root->appendChild($title);
        $band  = $doc->createElement('BAND', $cd->band);
        $band  = $root->appendChild($band);
        return $doc->saveXML();
    }
}
class CDAsJSONStrategy
{
    public function get(CDusesStrategy $cd)
    {
        $json                = array();
        $json['CD']['title'] = $cd->title;
        $json['CD']['band']  = $cd->band;
        return json_encode($json);
    }
}

$cd = new CDusesStrategy($externalTitle, $externalBand);
//xml output
$cd->setStrategyContext(new CDAsXMLStrategy());
print $cd->get();
//json output
$cd->setStrategyContext(new CDAsJSONStrategy());
print $cd->get($cd);
