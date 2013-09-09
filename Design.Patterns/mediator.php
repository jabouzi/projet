<?php

class CD
{
    public $band = '';
    public $title = '';
    protected $_mediator;
    public function __construct($mediator = null)
    {
        $this->_mediator = $mediator;
    }
    public function save()
    {
        //stub - writes data back to database - use this to verify
        var_dump($this);
    }
    public function changeBandName($newName)
    {
        if (!is_null($this->_mediator)) {
            $this->_mediator->change($this, array(
                'band' => $newName
            ));
        }
        $this->band = $newName;
        $this->save();
    }
}

class MP3Archive
{
    public $band = '';
    public $title = '';
    protected $_mediator;
    public function __construct($mediator = null)
    {
        $this->_mediator = $mediator;
    }
    public function save()
    {
        //stub - writes data back to database - use this to verify
        var_dump($this);
    }
    public function changeBandName($newName)
    {
        if (!is_null($this->_mediator)) {
            $this->_mediator->change($this, array(
                'band' => $newName
            ));
        }
        $this->band = $newName;
        $this->save();
    }
}

class MusicContainerMediator
{
    protected $_containers = array();
    public function __construct()
    {
        $this->_containers[] = 'CD';
        $this->_containers[] = 'MP3Archive';
    }
    public function change($originalObject, $newValue)
    {
        $title = $originalObject->title;
        $band  = $originalObject->band;
        foreach ($this->_containers as $container) {
            if (!($originalObject instanceof $container)) {
                $object        = new $container($this);
                $object->title = $title;
                $object->band  = $band;
                foreach ($newValue as $key => $val) {
                    $object->$key = $val;
                }
                $object->save();
            }
        }
    }
}

$titleFromDB = 'Waste of a Rib';
$bandFromDB  = 'Never Again';
$mediator    = new MusicContainerMediator();
$cd          = new CD($mediator);
$cd->title   = $titleFromDB;
$cd->band    = $bandFromDB;
var_dump($cd);
$cd->changeBandName('Maybe Once More');
