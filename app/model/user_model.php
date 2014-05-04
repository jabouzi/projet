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

	public function add_user($userdata)
	{
		$userdata['user_vhost'] = adjust_vhosts($userdata['user_vhost']);
		$builder = new userdatabuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->accountdao->insert_info($user);
		$this->accountdao->insert_vhosts($user);
	}

	public function update_user($userdata)
	{
		$userdata['user_vhost'] = adjust_vhosts($userdata['user_vhost']);
		$builder = new userdatabuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->accountdao->update_info($user);
		$this->accountdao->update_vhosts($user);
	}
	
	public function delete_user($user_name)
	{
		$this->accountdao->delete_info($user_name);
	}

	public function get_user($user_name)
	{
		return $this->accountdao->select_account($user_name);
	}

	public function get_users()
	{
		return $this->accountdao->select_all();
	}

	public function user_email_exists($user_email, $user_name = '')
	{
		$and = '';
		$args = array(
			':user_email' => $user_email
		);
		if ($user_name != '')
		{
			$args[':user_name'] = $user_name;
			$and = ' AND user_name != :user_name';
		}
		$query = "SELECT count(*) as count FROM user_info WHERE user_email = :user_email {$and} ";
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
