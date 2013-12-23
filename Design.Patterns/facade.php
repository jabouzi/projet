<?php

class CD
{
    public $tracks = array();
    public $band = '';
    public $title = '';
    public function __construct($title, $band, $tracks)
    {
        $this->title  = $title;
        $this->band   = $band;
        $this->tracks = $tracks;
    }
}

$tracksFromExternalSource = array(
    'What It Means',
    'Brrr',
    'Goodbye'
);
$title = 'Waste of a Rib';
$band = 'Never Again';
$cd = new CD($title, $band, $tracksFromExternalSource);

class CDUpperCase
{
    public static function makeString(CD $cd, $type)
    {
        $cd->$type = strtoupper($cd->$type);
    }
    public static function makeArray(CD $cd, $type)
    {
        $cd->$type = array_map('strtoupper', $cd->$type);
    }
}

class CDMakeXML
{
    public static function create(CD $cd)
    {
        $doc    = new DomDocument();
        $root   = $doc->createElement('CD');
        $root   = $doc->appendChild($root);
        $title  = $doc->createElement('TITLE', $cd->title);
        $title  = $root->appendChild($title);
        $band   = $doc->createElement('BAND', $cd->band);
        $band   = $root->appendChild($band);
        $tracks = $doc->createElement('TRACKS');
        $tracks = $root->appendChild($tracks);
        foreach ($cd->tracks as $track) {
            $track = $doc->createElement('TRACK', $track);
            $track = $tracks->appendChild($track);
        }
        return $doc->saveXML();
    }
}

class WebServiceFacade
{
    public static function makeXMLCall(CD $cd)
    {
        CDUpperCase::makeString($cd, 'title');
        CDUpperCase::makeString($cd, 'band');
        CDUpperCase::makeArray($cd, 'tracks');
        $xml = CDMakeXML::create($cd);
        return $xml;
    }
}

print WebServiceFacade::makeXMLCall($cd);
