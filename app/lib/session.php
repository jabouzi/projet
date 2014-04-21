<?php

class DatabaseSessionHandler {
    private $db;

    public function _open($save_path, $session_name)
    {
        require_once('app/config/config.php');
        $this->db = Database::getInstance();
        $this->db->setHost($config['host']);
        $this->db->setUsername($config['username']);
        $this->db->setPassword($config['password']);
        $this->db->setDatabase($config['database']);
        $this->db->setDriver($config['driver']);
        $this->db->connect();

        return true;
    }

    public function _close()
    {
        $this->db->close();
    }

    function _read($session_id)
    {
        $args = array(':session_id' => $session_id);
        $query = "SELECT user_data FROM SESSION WHERE session_id = :session_id";
		$result = $this->db->query($query, $args);
		return unserialize($result[0]);
    }

    function _write($session_id, $user_data)
    {
        $args = array(':session_id' => $session_id,
					':ip_address' => $this->ip_address,
					':user_agent' => $this->user_agent(),
					':last_activity' => time(),
					':user_data' => serialize($user_data));
        $query = "REPLACE INTO SESSION VALUES (:session_id, :ip_address, :user_agent, :last_activity, :user_data)";
        return $this->db->query($query, $args);
    }

    function _destroy($session_id) {
        $args = array(':session_id' => $session_id);
        $query = "DELETE FROM SESSION WHERE id = ':id'";
        return $this->db->query($query, $args);
    }

    function _clean($max)
    {
        $old = time() - $max;
		$args = array(':old' => $old);
        $query = "DELETE FROM SESSION  WHERE access < ':old'";
        return $this->db->query($query, $args);
    }

    public function killUserSession($username)
    {
		$args = array(':username' => $username);
        $query = "delete from SESSION where data like('%userID|s:%\":username%\";first_name|s:%')";
        $this->db->query($query);
    }

    private function user_agent()
	{
		$user_agent = ( ! isset($_SERVER['HTTP_USER_AGENT'])) ? FALSE : $_SERVER['HTTP_USER_AGENT'];
		return $this->user_agent;
	}

	private function ip_address()
	{
		return $_SERVER['REMOTE_ADDR'];
	}

}
?>
