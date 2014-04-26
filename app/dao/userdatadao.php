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

		$query = "INSERT INTO user_data VALUES ('', :email, :first_name, :last_name, :user_name, :password)";
		$this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$user->user_name);
		$this->cache->delete('select_admin_all');
		return $this->db->lastInsertId();
	}

	public function update($user)
	{
		$args = array(
				':email' => $user->email,
				':first_name' => $user->first_name,
				':last_name' => $user->last_name,
				':user_name' => $user->user_name,
				':password' => $user->password
			);

		$query = "UPDATE user_data SET
				email = :email, first_name = :first_name, last_name = :last_name, password = :password
				WHERE user_name = :user_name ";
		$update = $this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$user->user_name);
		$this->cache->delete('select_admin_all');
		return $update;
	}

	public function set_admin($uer_name, $is_admin)
	{
		$args = array(
			':user_name' => $user_name,
			':admin' => $admin
		);
		$query = "UPDATE user_data SET admin = :admin WHERE user_name = :user_name ";
		$set = $this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$uer_name);
		$this->cache->delete('select_admin_all');
		return $set;
	}
	
	public function set_profile($uer_name, $has_profile)
	{
		$args = array(
			':user_name' => $user_name,
			':profile' => $profile
		);
		$query = "UPDATE user_data SET profile = :profile WHERE user_name = :user_name ";
		$set = $this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$uer_name);
		$this->cache->delete('select_admin_all');
		return $set;
	}
	
	public function set_status($uer_name, $status)
	{
		$args = array(
			':user_name' => $user_name,
			':status' => $status
		);
		$query = "UPDATE user_data SET status = :status WHERE user_name = :user_name ";
		$set = $this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$uer_name);
		$this->cache->delete('select_admin_all');
		return $set;
	}
	
	public function delete($uer_name)
	{
		$args = array(
			':user_name' => $user_name
		);
		$query = "DELETE FROM user_data WHERE user_name = :user_name ";
		$delete = $this->db->query($query, $args);
		$this->cache->delete('select_admin_'.$uer_name);
		$this->cache->delete('select_admin_all');
		return $delete;
	}

	public function select_all()
	{
		if ($this->cache->get('select_admin_all')) return $this->cache->get('select_admin_all');
		$args = array();
		$users = array();
		$query = "SELECT * FROM user_data ";
		$results = $this->db->query($query, $args);
		foreach($results as $result)
		{
			$builder = new useradminbuilder($result);
			$builder->build();
			$users[] = $builder->getUser();
		}
		$this->cache->save('select_admin_all');
		return $users;
	}

	public function select_user($user_name)
	{
		if ($this->cache->get('select_admin_'.$user_name)) return $this->cache->get('select_admin_'.$user_name);
		$args = array(
			':user_name' => $user_name
		);
		$query = "SELECT * FROM user_data WHERE user_name = :user_name";
		$results = $this->db->query($query, $args);
		$builder = new useradminbuilder($result);
		$builder->build();
		$user = $builder->getUser();
		$this->cache->save('select_admin_'.$user_name, $user);
		return $user;
	}

}
