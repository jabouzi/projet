<?php

class Useradmindao {

	private $db;
	private $encrypt;

	function __construct()
	{
		$this->db = Database::getInstance();
		$this->encrypt = encryption();
	}

	public function insert($user)
	{
		$args = array(
				':email' => $user->email,
				':first_name' => $user->first_name,
				':last_name' => $user->last_name,
				':user_name' => $user->user_name,
				':password' => $this->encrypt->encrypt($user->password)
			);

		$query = "INSERT INTO user_data VALUES ('', :email, :first_name, :last_name, :user_name, :password)";
		$this->db->query($query, $args);
		return $this->db->lastInsertId();
	}

	public function update($user)
	{
		$args = array(
				':email' => $user->email,
				':first_name' => $user->first_name,
				':last_name' => $user->last_name,
				':user_name' => $user->user_name,
				':password' => $this->encrypt->encrypt($user->password)
			);

		$query = "UPDATE user_data SET
				email = :email, first_name = :first_name, last_name = :last_name, password = :password
				WHERE user_name = :user_name ";
		return $this->db->query($query, $args);
	}

	public function delete($uer_name)
	{
		$args = array(
			':user_name' => $user_name
		);
		$query = "DELETE FROM user_data WHERE user_name = :user_name ";
		$delete = $this->db->query($query, $args);
		return $delete;
	}

	public function select_all()
	{
		$args = array();
		$query = "SELECT * FROM user_data ";
		$results = $this->db->query($query, $args);
		foreach($results as $result)
		{
			$builder = new useradminbuilder($result);
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
		$query = "SELECT * FROM user_data WHERE user_name = :user_name";
		$results = $this->db->query($query, $args);
		foreach($results as $result)
		{
			$builder = new useradminbuilder($result);
			$builder->build();
			$users[] = $builder->getUser();
		}

		return $users;
	}

}
