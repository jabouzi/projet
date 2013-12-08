<?php

class Defaults extends Controller
{
    function __construct()
    {
        $this->user = new User();
    }
    
    public function index()
    {
        view::load_view('header');
        view::load_view('defaults');
        view::load_view('footer');
    }
    
    public function test()
    {
        $data['var1'] = 'Test1';
        view::load_view('header');
        view::load_view('defaults', $data);
        view::load_view('footer');
    } 
    
    public function test2($p1, $p2)
    {
        $data['var1'] = 'Test2';
        $data['var2'] = $p1 + $p2;
        view::load_view('header');
        view::load_view('defaults', $data);
        view::load_view('defaults2', $data);
        view::load_view('footer');
    }
    
    public function insert()
    {
        $user = array('id' => '', 'username' => 'skander', 'password' => base64_encode('7024043'), 'admin' => 1);
        $this->user->add_user($user);
    }
    
    public function user($id)
    {
        $user = $this->user->get_user($id);
        $data['user'] = $user[0];
        view::load_view('user', $data);
    }
}
