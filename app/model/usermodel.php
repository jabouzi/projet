<?php

class Usermodel extends Model
{
	private $userdata;
	private $userdatadao;
	private $cache;
	private $log;

	public function __construct()
	{
		parent::__construct();
		$this->userdata = new userdata();
		$this->userdatadao = new userdatadao();
		$this->cache = new cachefactory();
		$this->log = Phplog::getInstance();
	}

	public function add_user($userdata)
	{
		$userdata['user_vhost'] = adjust_vhosts($userdata['user_vhost']);
		$builder = new userdatabuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->userdatadao->insert_user($user);
		$this->userdatadao->insert_vhost($user);
		$this->cache->delete('select_data_'.$userdata['user_name']);
		$this->cache->delete('select_data_all');
		$this->log->save('ADD USER', $userdata);
	}

	public function update_user($userdata)
	{
		$userdata['user_vhost'] = adjust_vhosts($userdata['user_vhost']);
		$builder = new userdatabuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->userdatadao->update_user($user);
		$this->userdatadao->update_vhost($user);
		$this->cache->delete('select_data_'.$userdata['user_name']);
		$this->cache->delete('select_data_all');
		$this->log->save('UPDATE USER', $userdata);
	}
	
	public function delete_user($user_name)
	{
		$this->userdatadao->delete_user($user_name);
		$this->cache->delete('select_data_'.$user_name);
		$this->cache->delete('select_data_all');
		$this->log->save('DELETE USER', $user_name);
	}

	public function get_user($user_name)
	{
		if ($this->cache->get('select_data_'.$user_name)) return $this->cache->get('select_data_'.$user_name);
		$result = $this->userdatadao->select_user($user_name);
		$builder = new userdatabuilder($result);
		$builder->build();
		$user = $builder->getUser();
		$this->cache->save('select_data_'.$user_name, $user);
		return $user;
	}

	public function get_users()
	{
		if ($this->cache->get('select_data_all')) return $this->cache->get('select_data_all');
		$users = array();
		$results = $this->userdatadao->select_all();
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

	public function user_email_exists($user_email, $user_name = '')
	{
		$and = '';
		$args = array(
			':user_email' => $user_email
		);
		if ($user_name != '')
		{
			$args[':user_name'] = $user_name;
			$and = ' AND user_name != :user_name';
		}
		$query = "SELECT count(*) as count FROM user_info WHERE user_email = :user_email {$and} ";
		$count = $this->db->query($query, $args);
		return intval($count[0]['count']);
	}

	public function user_name_exists($user_name)
	{
		$args = array(
			':user_name' => $user_name
		);
		$query = "SELECT count(*) as count FROM user_info WHERE user_name = :user_name";
		$count = $this->db->query($query, $args);
		return intval($count[0]['count']);
	}
}
