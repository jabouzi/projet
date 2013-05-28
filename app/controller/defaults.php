<?php

class Defaults extends Controller
{
    function __construct()
    {

    }
    
    public function test()
    {
        $data['var1'] = 'Test1';
        var_dump($data);
        view::load_view('defaults', $data);
    } 
    
    public function test2($p1, $p2)
    {
        $data['var1'] = 'Test1';
        $data['var2'] = $p1 + $p2;
        view::load_view('defaults', $data);
        view::load_view('defaults2', $data);
    }
}
