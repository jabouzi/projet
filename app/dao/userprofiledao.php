<?php

class Userdao {

	private $db;

	function __construct()
	{
		$this->db = Database::getInstance();
	}

	public function insert_info($user)
	{
		$args_info = array(
			':user_name' => $user->user_name,
			':password' => $user->password
			':group' => $user->password
		);
		$query = "INSERT INTO user_info VALUES (:user_name, encrypt(:password), :group)";
		$insert = $this->db->query($query, $args_info);

		return $insert;
	}

	public function insert_vhosts($user)
	{
		$insert = 0;
		foreach($user->vhosts as $vhost)
		{
			$args_vhost = array(
				':user_name' => $user->user_name,
				':vhost' => $host
			);
			$query = "INSERT INTO user_vhosts VALUES (:user_name, :vhost)";
			$insert += $this->db->query($query, $args_vhost);
		}

		return ($insert == count($user->vhosts));
	}

	public function update_info($user)
	{
		$args = array(
			':user_name' => $user->user_name,
			':password' => $user->password
			':group' => $user->password
		);
		$query = "UPDATE user_info SET
				password = :password, group = :group
				WHERE user_name = :user_name";
		return $this->db->query($query, $args);
	}

	public function update_vhost($user)
	{
		delete_vhost($user);
		$update = insert_vhosts($user);
		return $update;
	}

	public function delete_info($user)
	{
		$args = array(
			':user_name' => $user_name
		);
		$query = "DELETE FROM user_info WHERE user_name = :user_name";
		$delete = $this->db->query($query, $args);
		$delete += delete_vhost($user_name);
		return $delete;
	}

	public function delete_vhost($user_name)
	{
		$args = array(
			':user_name' => $user_name
		);
		$query = "DELETE FROM user_vhosts WHERE user_name = :user_name";
		$delete = $this->db->query($query, $args);
		return $delete;
	}

	public function select_all()
	{
		$users = array();

		$query = "SELECT * FROM user_info ";
		$results = $this->db->query($query, array());
		foreach($results as $result)
		{
			$builder = new userprofilebuilder($result);
			$builder->build();
			$users[] = $builder->getUser();
		}

		return $users;
	}

	public function select_user($user_name)
	{
		$users = array();
		$args = array(
			':user_name' => $user_name
		);
		$query = "SELECT * FROM user_info WHERE user_name = :user_name";
		$results = $this->db->query($query, $args);
		foreach($results as $result)
		{
			$builder = new userprofilebuilder($result);
			$builder->build();
			$users[] = $builder->getUser();
		}

		return $users;
	}

}
