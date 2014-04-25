<?php

class Userdao {

    private $db;
	
	function __construct()
	{
		$this->db = Database::getInstance();
	}
    
    public function insert($user)
    {
        $args_info = array(
                ':user_name' => $user->user_name,
                ':password' => $user->password
                ':group' => $user->password
            );
            
        $args_vhost = array(
                ':user_name' => $user->user_name,
                ':vhost' => $user->vhost
            );
            
        $query = "INSERT INTO user_info VALUES (:user_name, encrypt(:password), :group)";
        $insert = $this->db->query($query, $args_info);
        
        $query = "INSERT INTO user_vhosts VALUES (:user_name, :vhost)";
        $insert += $this->db->query($query, $args_vhost);
        
        return $insert;

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
		foreach($user->vhost as $vhost)
		{
			$args_vhost = array(
					':user_name' => $user->user_name,
					':vhost' => $vhost
				);
			
			$query = "UPDATE user_vhost SET 
					vhost = :vhost
					WHERE user_name = :user_name";
			$update += $this->db->query($query, $args);
		}
		
		return $update;
    }
    
    public function delete_info($user)
    {
		$this->delete_vhost($user);
        $query = "DELETE FROM user_data {$sql_where} ";
        $this->db->query($query, $args);
        return $this->db->lastInsertId();
    }
    
    public function delete_vhost($user)
    {
        $query = "DELETE FROM user_data {$sql_where} ";
        $this->db->query($query, $args);
        return $this->db->lastInsertId();
    }
    
    public function select_all($select = array())
    {
        $args = array();
        $sql_select = ' * ';
        if (count($select)) $sql_select = implode(", ", $select);
        $query = "SELECT {$sql_select} FROM user_data ";
        $results = $this->db->query($query, $args);
        foreach($results as $result)
        {
			$builder = new userbuilder($result);
			$builder->build();
            $users[] = $builder->getUser();
        }
        
        return $users;
    }
    
    public function select_user($where, $select = array())
    {
        $users = array();
        $args = array();
        foreach($where as $key => $value)
        {
            $args[':'.$key] = $value;
        }
        
        $i = 0;
        foreach($where as $key => $value)
        {
            if (!$i) $where_sql = "WHERE :{$key} = {$key}";
            else $where_sql .= " AND {$key} = {$key}";
            $i++;
        }
        
        $sql_select = ' * ';
        if (count($select)) $sql_select = implode(", ", $select);
        $query = "SELECT {$sql_select} FROM user_data {$where_sql} ";
        $results = $this->db->query($query, $args);
        foreach($results as $result)
        {
            $users[] = new userbuilder($result);
        }
        
        return $users;
    }

}
