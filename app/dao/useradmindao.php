<?php

class Useradmindao {

	private $db;
	private $cache;

	function __construct()
	{
		$this->db = Database::getInstance();
		$this->cache = new cachefactory();
	}

	public function insert($user)
	{
		$args = array(
				':email' => $user->email,
				':first_name' => $user->first_name,
				':last_name' => $user->last_name,
				':user_name' => $user->user_name,
				':password' => $user->password
			);

		$query = "INSERT INTO user_admin VALUES ('', :email, :first_name, :last_name, :user_name, :password)";
		$this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$user->user_name);
		$this->cache->delete('select_admin_all');
		return $this->db->lastInsertId();
	}

	public function update($user, $email)
	{
		$args = array(
				':email' => $user->email,
				':first_name' => $user->first_name,
				':last_name' => $user->last_name,
				':user_name' => $user->user_name,
				':password' => $user->password,
				':old_email' => $email
			);

		$query = "UPDATE user_admin SET
				email = :email, first_name = :first_name, last_name = :last_name, user_name = :user_name, password = :password
				WHERE email = :old_email";
		$update = $this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$email);
		$this->cache->delete('select_admin_all');
		return $update;
	}

	public function set_admin($email, $is_admin)
	{
		$args = array(
			':email' => $email,
			':admin' => $is_admin
		);
		$query = "UPDATE user_admin SET admin = :admin WHERE email = :email ";
		$set = $this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$email);
		$this->cache->delete('select_admin_all');
		return $set;
	}

	public function set_status($email, $status)
	{
		$args = array(
			':email' => $email,
			':status' => $status
		);
		$query = "UPDATE user_admin SET status = :status WHERE email = :email ";
		$set = $this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$email);
		$this->cache->delete('select_admin_all');
		return $set;
	}

	public function delete($email)
	{
		$args = array(
			':email' => $email
		);
		$query = "DELETE FROM user_admin WHERE email = :email ";
		$delete = $this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$email);
		$this->cache->delete('select_admin_all');
		return $delete;
	}

	public function select_all()
	{
		if ($this->cache->get('select_admin_all')) return $this->cache->get('select_admin_all');
		$args = array();
		$users = array();
		$query = "SELECT * FROM user_admin ";
		$results = $this->db->query($query, $args);
		if (!count($results)) return false;
		foreach($results as $result)
		{
			$builder = new useradminbuilder($result);
			$builder->build();
			$users[] = $builder->getUser();
		}
		$this->cache->save('select_admin_all');
		return $users;
	}

	public function select_user($email)
	{
		if ($this->cache->get('select_admin_'.$email)) return $this->cache->get('select_admin_'.$email);
		$args = array(
			':email' => $email
		);
		$query = "SELECT * FROM user_admin WHERE email = :email";
		$result = $this->db->query($query, $args);
		if (!count($result)) return false;
		$builder = new useradminbuilder($result[0]);
		$builder->build();
		$user = $builder->getUser();
		$this->cache->save('select_admin_'.$email, $user);
		return $user;
	}

}
