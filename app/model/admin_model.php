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
	}

	public function update_user($userdata)
	{
		$builder = new useradminbuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->admindao->update($user);
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

	public function email_exists($email, $id)
	{
		$args = array(
			':email' => $email,
			':id' => $id
		);
		$query = "SELECT count(*) as count FROM user_admin WHERE email = :email AND id != :id";
		$count = $this->db->query($query, $args);
		return intval($count[0]['count']);
	}
	
	public function get_email_by_id($id)
	{
		$args = array(
			':id' => $id
		);
		$query = "SELECT email FROM user_admin WHERE id = :id";
		$count = $this->db->query($query, $args);
		return intval($count[0]['email']);
	}
}
