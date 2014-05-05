<?php

class Admin_model extends Model
{
	private $admin;
	private $admindao;
	private $encrypt;

	public function __construct()
	{
		parent::__construct();
		$this->admin = new useradmin();
		$this->admindao = new useradmindao();
		$this->encrypt = new encryption();
	}

	public function add_user($userdata)
	{
		if (!isset($userdata['admin'])) $userdata['admin'] = 0;
		if (!isset($userdata['status'])) $userdata['status'] = 0;
		$userdata['password'] = $this->encrypt->encrypt($userdata['password']);
		$builder = new useradminbuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->admindao->insert($user);
	}

	public function update_user($userdata)
	{
		if (!isset($userdata['admin'])) $userdata['admin'] = 0;
		if (!isset($userdata['status'])) $userdata['status'] = 0;
		$userdata['password'] = $this->encrypt->encrypt($userdata['password']);
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
		$users = $this->admindao->select_all();
		foreach($users as $key => $user)
		{
			if ($user->get_id() == $_SESSION['user']['id']) unset($users[$key]);
		}
		return $users;
	}

	public function email_exists($email, $id = '')
	{
		$and = '';
		$args = array(
			':email' => $email,
		);
		if ($id != '')
		{
			$args[':id'] = $id;
			$and = ' AND id != :id';
		}
		$query = "SELECT count(*) as count FROM user_admin WHERE email = :email {$and}";
		$count = $this->db->query($query, $args);
		return intval($count[0]['count']);
	}
	
	public function get_email_by_id($id)
	{
		$args = array(
			':id' => $id
		);
		$query = "SELECT email FROM user_admin WHERE id = :id";
		$email = $this->db->query($query, $args);
		return $email[0]['email'];
	}
}
