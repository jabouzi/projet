<?php
class useriterator implements Iterator
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function rewind()
    {
        echo "rewinding\n";
        reset($this->var);
    }
  
    public function current()
    {
        $var = current($this->var);
        echo "current: $var\n";
        return $var;
    }
  
    public function key() 
    {
        $var = key($this->var);
        echo "key: $var\n";
        return $var;
    }
  
    public function next() 
    {
        $var = next($this->var);
        echo "next: $var\n";
        return $var;
    }
  
    public function valid()
    {
        $key = key($this->var);
        $var = ($key !== NULL && $key !== FALSE);
        echo "valid: $var\n";
        return $var;
    }

}

//$values = array(1,2,3);
//$it = new MyIterator($values);

//foreach ($it as $a => $b) {
    //print "$a: $b\n";
//}
?>
