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
        echo "rewinding\n";
        reset($this->users);
    }
  
    public function current()
    {
        $user = current($this->users);
        echo "current: $user->user_name";
        return $user;
    }
  
    public function key() 
    {
        $user = key($this->users);
        echo "key: $user->user_name";
        return $user;
    }
  
    public function next() 
    {
        $user = next($this->users);
        echo "next: $user->user_name";
        return $user;
    }
  
    public function valid()
    {
        $key = key($this->users);
        $user = ($key !== NULL && $key !== FALSE);
        echo "valid: $user->user_name";
        return $user;
    }

}

//$values = array(1,2,3);
//$it = new MyIterator($values);

//foreach ($it as $a => $b) {
    //print "$a: $b\n";
//}
?>
