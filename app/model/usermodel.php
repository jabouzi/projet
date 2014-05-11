<?php

class Usermodel extends Model
{
	private $userdata;
	private $userdatadao;

	public function __construct()
	{
		parent::__construct();
		$this->userdata = new userdata();
		$this->userdatadao = new userdatadao();
	}

	public function add_user($userdata)
	{
		$userdata['user_vhost'] = adjust_vhosts($userdata['user_vhost']);
		$builder = new userdatabuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->userdatadao->insert_info($user);
		$this->userdatadao->insert_vhost($user);
	}

	public function update_user($userdata)
	{
		$userdata['user_vhost'] = adjust_vhosts($userdata['user_vhost']);
		$builder = new userdatabuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->userdatadao->update_info($user);
		$this->userdatadao->update_vhost($user);
	}
	
	public function delete_user($user_name)
	{
		$this->userdatadao->delete_info($user_name);
	}

	public function get_user($user_name)
	{
		return $this->userdatadao->select_user($user_name);
	}

	public function get_users()
	{
		return $this->userdatadao->select_all();
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
