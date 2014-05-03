<?php

class useriterator implements Iterator
{
    private $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function rewind()
    {
        reset($this->users);
    }
  
    public function current()
    {
        $user = current($this->users);
        return $user;
    }
  
    public function key() 
    {
        $user = key($this->users);
        return $user;
    }
  
    public function next() 
    {
        $user = next($this->users);
        return $user;
    }
  
    public function valid()
    {
        $key = key($this->users);
        $user = ($key !== NULL && $key !== FALSE);
        return $user;
    }
}
