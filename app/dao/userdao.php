<?php

class Userdao {

    private $db;
	
	function __construct()
	{
		$this->db = Database::getInstance();
	}
    
    public function insert($user)
    {
        $args = (
                ':email' => $user->email, 
                ':first_name' => $user->first_name, 
                ':last_name' => $user->last_name,
                ':user_name' => $user->user_name,
                ':password' => $user->password
            );
            
        $query = "INSERT INTO user_data VALUES ('', :email, :first_name, :last_name, :user_name, :password";
        $this->db->query($query, $args);
        return $this->db->lastInsertId();
    }
    
    public function update($user, $where)
    {
        $args = (
                ':email' => $user->email, 
                ':first_name' => $user->first_name, 
                ':last_name' => $user->last_name,
                ':user_name' => $user->user_name,
                ':password' => $user->password
            );
            
        $query = "INSERT INTO user_data VALUES ('', :email, :first_name, :last_name, :user_name, :password";
        $this->db->query($query, $args);
    }
    
    public function delete($where)
    {
            
        $query = "INSERT INTO user_data VALUES ('', :email, :first_name, :last_name, :user_name, :password";
        $this->db->query($query, $args);
        return $this->db->lastInsertId();
    }
    
    public function select_all($select = array())
    {
        $args = array();
        $sql_select = ' * ';
        if (count($select)) $sql_select = implode(", ", $select);
        $query = "SELECT {$select} FROM user_data ";
        $results = $this->db->query($query, $args);
        foreach($results as $result)
        {
            $users[] = new userbuilder($result);
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
