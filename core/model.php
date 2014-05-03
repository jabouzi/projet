<?php

class Model implements Interfacedb
{
    private $bd = null;
    
    function __construct()
    {
        $this->db = Database::getInstance(); 
    }
    
    public function select_all($table, $select = array())
    {
        $args = array();
        $sql_select = ' * ';
        if (count($select)) $sql_select = implode(", ", $select);
        $query = "SELECT {$sql_select} FROM {$table} ";
        return $this->db->query($query, $args);
    }
    
    public function select($table, $where, $select = array())
    {
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
        $query = "SELECT {$sql_select} FROM {$table} {$where_sql} ";
        return $this->db->query($query, $args);
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
        
        $query = "insert INTO {$table} (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $values) . ")";
        $res = $this->db->query($query, $args);
        return $res;
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
        foreach($where as $key => $value)
        {
            if (!$i) $where_sql = "WHERE :{$key} = {$key}";
            else $where_sql .= " AND {$key} = {$key}";
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
        return $this->db->query($query, array_merge($args1, $args2));
    }
    
    public function delete($table, $where)
    {
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
        
        $query = "DELETE FROM {$table} {$where_sql} ";
        return $this->db->query($query, $args);
    }
    
    public function get_last_inert_id()
    {
        return $this->db->lastInsertId();
    }
}
