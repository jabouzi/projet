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
				':email' => $user->get_email(),
				':first_name' => $user->get_first_name(),
				':last_name' => $user->get_last_name(),
				':password' => $user->get_password(),
				':admin' => $user->get_admin(),
				':status' => $user->get_status()
			);

		$query = "INSERT INTO user_admin VALUES ('', :email, :first_name, :last_name, :password, :admin, :status)";
		$this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$user->get_email());
		$this->cache->delete('select_admin_all');
		return $this->db->lastInsertId();
	}

	public function update($user)
	{
		$password = '';
		$args = array(
				':email' => $user->get_email(),
				':first_name' => $user->get_first_name(),
				':last_name' => $user->get_last_name(),
				':admin' => $user->get_admin(),
				':status' => $user->get_status(),
				':id' => $user->get_id()
			);
		if (!isempty($user->get_password()))
		{
			$args[':password'] == $user->get_password();
			$password = ', password = :password';
		}
		$query = "UPDATE user_admin SET
				email = :email, first_name = :first_name, last_name = :last_name, admin = :admin, status = :status {$password}
				WHERE id = :id";
		$update = $this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$user->get_email());
		$this->cache->delete('select_admin_all');
		return $update;
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
		$this->cache->save('select_admin_all', $results);
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
