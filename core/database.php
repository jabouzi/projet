<?php

interface Database 
{
    public function insert();
    public function update();
    public function delete();
    public function get_last_inert_id();
}
