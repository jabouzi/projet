<?php

interface Interfacedb
{
    public function select_all($table);
    public function select($table, $where);
    public function insert($table, $data);
    public function update($table, $data, $where);
    public function delete($table, $where);
    public function get_last_inert_id();
}
