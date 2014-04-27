<?php

class Userprofiledao {

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

		$query = "INSERT INTO user_profile VALUES ('', :email, :first_name, :last_name, :user_name, :password)";
		$this->db->query($query, $args);
		$this->cache->delete('select_profile_'.$user->user_name);
		$this->cache->delete('select_profile_all');
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

		$query = "UPDATE user_profile SET
				email = :email, first_name = :first_name, last_name = :last_name, user_name = :user_name, password = :password
				WHERE email = :old_email";
		$update = $this->db->query($query, $args);
		$this->cache->delete('select_profile_'.$email);
		$this->cache->delete('select_profile_all');
		return $update;
	}

	public function set_admin($email, $is_admin)
	{
		$args = array(
			':email' => $email,
			':admin' => $is_admin
		);
		$query = "UPDATE user_profile SET admin = :admin WHERE email = :email ";
		$set = $this->db->query($query, $args);
		$this->cache->delete('select_profile_'.$email);
		$this->cache->delete('select_profile_all');
		return $set;
	}
	
	public function set_profile($email, $has_profile)
	{
		$args = array(
			':email' => $email,
			':profile' => $has_profile
		);
		$query = "UPDATE user_profile SET profile = :profile WHERE email = :email ";
		$set = $this->db->query($query, $args);
		$this->cache->delete('select_profile_'.$email);
		$this->cache->delete('select_profile_all');
		return $set;
	}
	
	public function set_status($email, $status)
	{
		$args = array(
			':email' => $email,
			':status' => $status
		);
		$query = "UPDATE user_profile SET status = :status WHERE email = :email ";
		$set = $this->db->query($query, $args);
		$this->cache->delete('select_profile_'.$email);
		$this->cache->delete('select_profile_all');
		return $set;
	}
	
	public function delete($email)
	{
		$args = array(
			':email' => $email
		);
		$query = "DELETE FROM user_profile WHERE email = :email ";
		$delete = $this->db->query($query, $args);
		$this->cache->delete('select_profile_'.$email);
		$this->cache->delete('select_profile_all');
		return $delete;
	}

	public function select_all()
	{
		if ($this->cache->get('select_profile_all')) return $this->cache->get('select_profile_all');
		$args = array();
		$users = array();
		$query = "SELECT * FROM user_profile ";
		$results = $this->db->query($query, $args);
		foreach($results as $result)
		{
			$builder = new userprofilebuilder($result);
			$builder->build();
			$users[] = $builder->getUser();
		}
		$this->cache->save('select_profile_all');
		return $users;
	}

	public function select_user($email)
	{
		if ($this->cache->get('select_profile_'.$email)) return $this->cache->get('select_profile_'.$email);
		$args = array(
			':email' => $email
		);
		$query = "SELECT * FROM user_profile WHERE email = :email";
		$results = $this->db->query($query, $args);
		$builder = new userprofilebuilder($result);
		$builder->build();
		$user = $builder->getUser();
		$this->cache->save('select_profile_'.$email, $user);
		return $user;
	}

}
