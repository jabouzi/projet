<?php

class Admin_model extends Model
{
	private $admin;
	private $admindao;

	public function __construct()
	{
		parent::__construct();
		$this->admin = new useradmin();
		$this->admindao = new useradmindao();
	}

	public function add_user($user)
	{
		$builder = new useradminbuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->admindao->insert($user);
		$this->admindao->set_admin($userdata['email'], $userdata['admin']);
		$this->admindao->set_status($userdata['email'], $userdata['status']);
	}

	public function update_user($userdata)
	{
		$builder = new useradminbuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->admindao->update($user, $userdata['old_email']);
		$this->admindao->set_admin($userdata['email'], $userdata['admin']);
		$this->admindao->set_status($userdata['email'], $userdata['status']);
	}
	
	public function delete_user($email)
	{
		$this->admindao->delete($email);
	}

	public function get_user($email)
	{
		return $this->admindao->select_user($email);
	}

	public function get_users()
	{
		return $this->admindao->select_all();
	}

	public function email_exists($email)
	{
		$args = array(
			':email' => $email
		);
		$query = "SELECT count(*) as count FROM user_admin WHERE email = :email";
		$count = $this->db->query($query, $args);
		return intval($count[0]['count']);
	}
}
