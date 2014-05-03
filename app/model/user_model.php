<?php

class User_model extends Model
{
	private $account;
	private $accountdao;
	
	public function __construct()
    {
        parent::__construct();
        $this->account = new userdata();
		$this->accountdao = new userdatadao();
    }
	
    public function add_user($user)
    {
        $this->insert('user', $user);
    }
    
    public function get_user($user_name)
    {
        return $this->select('user', array('id' => $id));
    }
    
    public function get_users()
    {
		return $this->accountdao->select_all();
	}
	
	public function user_email_exists($user_email)
	{
		$args = array(
			':user_email' => $email
		);
		$query = "SELECT count(*) as count FROM user_info WHERE user_email = :user_email";
		$count = $this->db->query($query, $args);
		return intval($count[0]['count']);
	}
	
	public function user_name_exists($user_name)
	{
		$args = array(
			':user_name' => $user_name
		);
		$query = "SELECT count(*) as count FROM user_info WHERE user_name = :user_name";
		$count = $this->db->query($query, $args);
		return intval($count[0]['count']);		
	}
}
