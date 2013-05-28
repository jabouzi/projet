<?php

class Model implements InterfaceDB
{
    private $bd = null;
    private last_insert_id = 0;
    
    function __construct()
    {
        require_once('app/config/config.php');
        $this->db = new Database();
        $this->db->setHost($config['host']);
        $this->db->setUsername($config['username']);
        $this->db->setPassword($config['password']);
        $this->db->setDatabase($config['database']);
        $this->db->setDriver($config['driver']);
        $this->db->connect(); 
    }
    
    public function select_all($table, $select = array())
    {
        $args = array();
        $sql_select = ' * ';
        if (count($select)) $sql_select = implode(", ", $select);
        $query = "SELECT {$select} FROM {$table} ";
        $this->db->query($query, $args);
    }
    
    public function select($table, $where, $select = array())
    {
        $args = array();
        
        foreach($where as $key => $value)
        {
            $args[':'.$key] = $value;
        }
        
        $i = 0;
        foreach($args as $key => $value)
        {
            if (!$i) $where_sql = "WHERE {$key} = {$value}";
            else $where_sql .= " AND {$key} = {$value}";
            $i++;
        }
        
        $sql_select = ' * ';
        if (count($select)) $sql_select = implode(", ", $select);
        $query = "SELECT {$select} FROM {$table} {$where_sql} ";
        $this->db->query($query, $args);
    }
    
    public function insert($table, $data)
    {
        $args = array();
        foreach($data as $key => $value)
        {
            $args[':'.$key] = $value;
        }
        
        $keys = array_keys($data);
        $values = array_keys($args);
        
        $query = "insert INTO {$table} (" . implode(", ", $keys) . ") VALUES ('" . implode("', '", $values) . "')";
        $this->db->query($query, $args);
        $this->last_insert_id = $this->db->last_insert_id;
    }
    
    public function update($table, $data, $where)
    {
        $args1 = array();
        $args2= array();
        
        foreach($where as $key => $value)
        {
            $args1[':'.$key] = $value;
        }
        
        $i = 0;
        foreach($args2 as $key => $value)
        {
            if (!$i) $where_sql = "WHERE {$key} = {$value}";
            else $where_sql .= " AND {$key} = {$value}";
            $i++;
        }
        
        foreach($data as $key => $value)
        {
            $args2[':'.$key] = $value;
        }
        $keys = array_keys($data);
        $values = array_keys($args2);
        
        for($i = 0; $i < count($keys); $i++)
        {
            $set_sql .= $keys[$i] ." = '{$values[$i]}'";
        }
        
        $query = "UPDATE {$table} SET {$set_sql} {$where_sql} ";
        $this->db->query($query, array_merge($args1, $args2));
    }
    
    public function delete($table, $where)
    {
        $args = array();
        
        foreach($where as $key => $value)
        {
            $args[':'.$key] = $value;
        }
        
        $i = 0;
        foreach($args as $key => $value)
        {
            if (!$i) $where_sql = "WHERE {$key} = {$value}";
            else $where_sql .= " AND {$key} = {$value}";
            $i++;
        }
        
        $query = "DELETE FROM {$table} {$where_sql} ";
        $this->db->query($query, $args);
    }
    
    public function get_last_inert_id()
    {
        return $this->last_insert_id;
    }
}
