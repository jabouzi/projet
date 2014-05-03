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
			':user_name' => $user->get_user_name(),
			':password' => $user->get_user_password(),
			':group' => $user->get_user_group(),
			':email' => $user->get_user_email(),
			':first_name' => $user->get_user_first_name(),
			':last_name' => $user->get_user_last_name()
		);
		$query = "INSERT INTO user_info VALUES (:user_name, encrypt(:password), :group, :first_name, :last_name, :email)";
		$insert = $this->db->query($query, $args_info);
		$this->cache->delete('select_data_'.$user->get_user_name());
		$this->cache->delete('select_data_all');
		return $insert;
	}

	public function insert_vhosts($user)
	{
		$insert = 0;
		foreach($user->get_user_vhosts() as $vhost)
		{
			$args_vhost = array(
				':user_name' => $user->get_user_name(),
				':vhost' => $vhost
			);
			$query = "INSERT INTO user_vhost VALUES (:user_name, :vhost)";
			$insert += $this->db->query($query, $args_vhost);
		}
		$this->cache->delete('select_data_'.$user->get_user_name());
		$this->cache->delete('select_data_all');
		return ($insert == count($user->get_user_vhosts()));
	}

	public function update_info($user)
	{
		$args = array(
			':user_name' => $user->get_user_name(),
			':password' => $user->get_user_password(),
			':group' => $user->get_user_group(),
			':email' => $user->get_user_email(),
			':first_name' => $user->get_user_first_name(),
			':last_name' => $user->get_user_last_name(),
		);
		var_dump($args);
		$query = "UPDATE user_info SET
				password = encrypt(:password), group = :group, user_email = :email, user_first_name = :first_name, user_last_name = :last_name
				WHERE user_name = :user_name";
		$update = $this->db->query($query, $args);
		var_dump($update);
		$this->cache->delete('select_data_'.$user->get_user_name());
		$this->cache->delete('select_data_all');
		return $update;
	}

	public function update_vhosts($user)
	{
		$this->delete_vhosts($user);
		$update = insert_vhosts($user);
		$this->cache->delete('select_data_'.$user->get_user_name());
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
		$delete += $this->delete_vhosts($user_name);
		$this->cache->delete('select_data_'.$uer_name);
		$this->cache->delete('select_data_all');
		return $delete;
	}

	public function delete_vhosts($user_name)
	{
		$args = array(
			':user_name' => $user_name
		);
		$query = "DELETE FROM user_vhost WHERE user_name = :user_name";
		$delete = $this->db->query($query, $args);
		$this->cache->delete('select_data_'.$user_name);
		$this->cache->delete('select_data_all');
		return $delete;
	}

	public function select_all()
	{
		if ($this->cache->get('select_data_all')) return $this->cache->get('select_data_all');
		$args = array();
		$users = array();
		$query = "SELECT * FROM user_info WHERE 1 ORDER BY user_name ASC";
		$results = $this->db->query($query, $args);
		if (!count($results)) return false;
		foreach($results as $result)
		{
			$result['user_vhost'] = array();
			$builder = new userdatabuilder($result);
			$builder->build();
			$users[] = $builder->getUser();
		}
		$this->cache->save('select_data_all', $users);
		return $users;
	}

	public function select_account($user_name)
	{
		if ($this->cache->get('select_data_'.$user_name)) return $this->cache->get('select_data_'.$user_name);
		$users = array();
		$args = array(
			':user_name' => $user_name
		);
		$query = "SELECT * FROM user_info WHERE user_name = :user_name";
		$result = $this->db->query($query, $args);
		if (!count($result)) return false;
		$query = "SELECT user_vhost FROM user_vhost WHERE user_name = :user_name";
		$result2 = $this->db->query($query, $args);
		foreach($result2 as $res)
		{
			$result[0]['user_vhost'][] = $res['user_vhost'];
		}
		$builder = new userdatabuilder($result[0]);
		$builder->build();
		$user = $builder->getUser();
		$this->cache->save('select_data_'.$user_name, $user);
		return $user;
	}
}
