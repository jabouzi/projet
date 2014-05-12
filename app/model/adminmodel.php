<?php

class Adminmodel extends Model
{
	private $admin;
	private $admindao;
	private $cache;
	private $log;

	public function __construct()
	{
		parent::__construct();
		$this->admin = new useradmin();
		$this->admindao = new useradmindao();
		$this->cache = new cachefactory();
		$this->log = Phplog::getInstance();
	}

	public function add_user($userdata)
	{
		if (!isset($userdata['admin'])) $userdata['admin'] = 0;
		if (!isset($userdata['status'])) $userdata['status'] = 0;
		$builder = new useradminbuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->admindao->insert($user);
		$this->cache->delete('select_admin_'.$userdata['email']);
		$this->cache->delete('select_admin_all');
		$this->log->save('ADD ADMIN', $userdata);
	}

	public function update_user($userdata)
	{
		if (!isset($userdata['admin'])) $userdata['admin'] = 0;
		if (!isset($userdata['status'])) $userdata['status'] = 0;
		$builder = new useradminbuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->admindao->update($user);
		$this->cache->delete('select_admin_'.$userdata['email']);
		$this->cache->delete('select_admin_all');
		$this->log->save('UPDATE ADMIN', $userdata);
	}

	public function delete_user($email)
	{
		$this->admindao->delete($email);
		$this->cache->delete('select_admin_'.$email);
		$this->cache->delete('select_admin_all');
		$this->log->save('UPDATE ADMIN', $email);
	}

	public function get_user($email)
	{
		if ($this->cache->get('select_admin_'.$email)) return $this->cache->get('select_admin_'.$email);
		$result = $this->admindao->select_user($email);
		$builder = new useradminbuilder($result);
		$builder->build();
		$user = $builder->getUser();
		$this->cache->save('select_admin_'.$email, $user);
		return $user;
	}

	public function get_users()
	{
		if ($this->cache->get('select_admin_all')) return $this->cache->get('select_admin_all');
		$users = array();
		$results = $this->admindao->select_all();
		foreach($results as $result)
		{
			if($_SESSION['user']['id'] != $result['id'])
			{
				$builder = new useradminbuilder($result);
				$builder->build();
				$users[] = $builder->getUser();
			}
		}
		$this->cache->save('select_admin_all', $users);
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
