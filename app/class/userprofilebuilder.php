<?php

class Userprofilebuilder
{
    protected $user = NULL;
    protected $user_data = array();
    
    public function __construct($user_data)
    {
        $this->user_data = $user_data;
    }
    public function build()
    {
        $this->user = new Userprofile();
        $this->user->set_email($this->user_data['email']);
        $this->user->set_first_name($this->user_data['first_name']);
        $this->user->set_last_name($this->user_data['last_name']);
        $this->user->set_user_name($this->user_data['user_name']);
        $this->user->set_password($this->user_data['password']);
       
    }
    public function getUser()
    {
        return $this->user;
    }
}
