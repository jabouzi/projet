<?php

class Userdatadao {

	private $db;
	private $cache;

	function __construct()
	{
		$this->db = Database::getInstance();
		$this->cache = new cachefactory();
	}

	public function insert_info($user)
	{
		$args_info = array(
			':user_name' => $user->user_name,
			':password' => $user->password,
			':group' => $user->group,
			':email' => $user->email,
			':first_name' => $user->first_name,
			':last_name' => $user->last_name,
		);
		$query = "INSERT INTO user_info VALUES (:user_name, encrypt(:password), :group, :email, :first_name, :last_name)";
		$insert = $this->db->query($query, $args_info);
		$this->cache->delete('select_data_'.$user->user_name);
		$this->cache->delete('select_data_all');
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
			$query = "INSERT INTO user_vhost VALUES (:user_name, :vhost)";
			$insert += $this->db->query($query, $args_vhost);
		}
		$this->cache->delete('select_data_'.$user->user_name);
		$this->cache->delete('select_data_all');
		return ($insert == count($user->vhosts));
	}

	public function update_info($user)
	{
		$args = array(
			':user_name' => $user->user_name,
			':password' => $user->password,
			':group' => $user->group,
			':email' => $user->email,
			':first_name' => $user->first_name,
			':last_name' => $user->last_name,
		);
		$query = "UPDATE user_info SET
				password = encrypt(:password), group = :group, email = :email, first_name = :first_name, last_name = :last_name
				WHERE user_name = :user_name";
		$update = $this->db->query($query, $args);
		$this->cache->delete('select_data_'.$user->user_name);
		$this->cache->delete('select_data_all');
		return $update;
	}

	public function update_vhost($user)
	{
		delete_vhost($user);
		$update = insert_vhosts($user);
		$this->cache->delete('select_data_'.$user->user_name);
		$this->cache->delete('select_data_all');
		return $update;
	}

	public function delete_info($user_name)
	{
		$args = array(
			':user_name' => $user_name
		);
		$query = "DELETE FROM user_info WHERE user_name = :user_name";
		$delete = $this->db->query($query, $args);
		$delete += delete_vhost($user_name);
		$this->cache->delete('select_data_'.$uer_name);
		$this->cache->delete('select_data_all');
		return $delete;
	}

	public function delete_vhost($user_name)
	{
		$args = array(
			':user_name' => $user_name
		);
		$query = "DELETE FROM user_vhost WHERE user_name = :user_name";
		$delete = $this->db->query($query, $args);
		$this->cache->delete('select_data_'.$uer_name);
		$this->cache->delete('select_data_all');
		return $delete;
	}

	public function select_all()
	{
		if ($this->cache->get('select_data_all')) return $this->cache->get('select_data_all');
		$args = array();
		$users = array();
		$query = "SELECT i.*, v.user_vhost FROM user_info i, user_vhost v WHERE i.user_name = v. user_name";
		$results = $this->db->query($query, $args);
		if (!count($results)) return false;
		foreach($results as $result)
		{
			$builder = new userdatabuilder($result);
			$builder->build();
			$users[] = $builder->getUser();
		}
		$this->cache->save('select_data_all');
		return $users;
	}

	public function select_user($user_name)
	{
		if ($this->cache->get('select_data_'.$user_name)) return $this->cache->get('select_data_'.$user_name);
		$users = array();
		$args = array(
			':user_name' => $user_name
		);
		$query = "SELECT i.*, v.user_vhost FROM user_info i, user_vhost v WHERE i.user_name = :user_name AND i.user_name = v. user_name";
		$result = $this->db->query($query, $args);
		if (!count($result)) return false;
		foreach($results as $result)
		{
			$builder = new userdatabuilder($result);
			$builder->build();
			$users[] = $builder->getUser();
		}
		$this->cache->save('select_data_'.$user_name, $user);
		return $users;
	}

}
