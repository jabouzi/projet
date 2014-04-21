<?php

class User_model extends Model
{
    public function add_user($user)
    {
        $this->insert('user', $user);
    }
    
    public function get_user($id)
    {
        return $this->select('user', array('id' => $id));
    }
}
