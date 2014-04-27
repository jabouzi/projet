<?php

class Session {
    
    private $db;

    public function _open($save_path, $session_name)
    {
        $this->db = Database::getInstance();
        return true;
    }

    public function _close()
    {
        $this->db->close();
    }

    function _read($session_id)
    {
        $args = array(':session_id' => $session_id);
        $query = "SELECT user_data FROM sessions WHERE session_id = :session_id";
		$result = $this->db->query($query, $args);
		if (count($result))
		{
			return unserialize($result[0]['user_data']);
		}
		
		return array();
    }

    function _write($session_id, $user_data)
    {
        $args = array(':session_id' => $session_id,
					':ip_address' => ip_address(),
					':user_agent' => user_agent(),
					':last_activity' => time(),
					':user_data' => serialize($user_data));
        $query = "REPLACE INTO sessions VALUES (:session_id, :ip_address, :user_agent, :last_activity, :user_data)";
        return $this->db->query($query, $args);
    }

    function _destroy($session_id) {
        $args = array(':session_id' => $session_id);
        $query = "DELETE FROM sessions WHERE id = ':id'";
        return $this->db->query($query, $args);
    }

    function _clean($max)
    {
        $old = time() - $max;
		$args = array(':old' => $old);
        $query = "DELETE FROM sessions  WHERE last_activity < ':old'";
        return $this->db->query($query, $args);
    }

    public function killUserSession($username)
    {
		$args = array(':username' => $username);
        $query = "delete from sessions where data like('%userID|s:%\":username%\";first_name|s:%')";
        $this->db->query($query);
    }  

}
?>
