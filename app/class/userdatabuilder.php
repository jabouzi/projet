<?php

class Userdataebuilder
{
    protected $user = NULL;
    protected $user_data = array();
    
    public function __construct($user_data)
    {
        $this->user_data = $user_data;
    }
    public function build()
    {
        $this->user = new Userdata();
        $this->user->set_user_name($this->user_data['user_name']);
        $this->user->set_user_password($this->user_data['password']);
        $this->user->set_user_group($this->user_data['email']);
        $this->user->set_user_vhosts($this->user_data['first_name']);
        $this->user->set_email($this->user_data['email']);
		$this->user->set_first_name($this->user_data['first_name']);
		$this->user->set_last_name($this->user_data['last_name']);
    }
    public function getUser()
    {
        return $this->user;
    }
}
