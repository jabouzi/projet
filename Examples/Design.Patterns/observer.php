<?php

class CD
{
    public $title = '';
    public $band = '';
    protected $_observers = array();
    public function __construct($title, $band)
    {
        $this->title = $title;
        $this->band  = $band;
    }
    public function attachObserver($type, $observer)
    {
        $this->_observers[$type][] = $observer;
    }
    public function notifyObserver($type)
    {
        if (isset($this->_observers[$type])) {
            foreach ($this->_observers[$type] as $observer) {
                $observer->update($this);
            }
        }
    }
    public function buy()
    {
        //stub actions of buying
        $this->notifyObserver('purchased');
    }
}

class buyCDNotifyStreamObserver
{
    public function update(CD $cd)
    {
        $activity = "The CD named {$cd->title} by ";
        $activity .= "{$cd->band} was just purchased.";
        activityStream::addNewItem($activity);
    }
}

class activityStream
{
    public static function addNewItem($item)
    {
        //stub functions
        print $item;
    }
}

$title    = 'Waste of a Rib';
$band     = 'Never Again';
$cd       = new CD($title, $band);
$observer = new buyCDNotifyStreamObserver();
$cd->attachObserver('purchased', $observer);
$cd->buy();
