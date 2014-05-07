<?php

class Mailerdecorator
{
	private $user;
	
	function __construct($user)
	{
		$this->user = $user;
	}
	
	public function decorate($email)
	{
		return sprintf(
				$email, 
				$this->user->get_user_first_name(), 
				$this->user->get_user_last_name(), 
				imlplode(', ', $this->user->get_user_vhosts()), 
				$this->user->get_user_name(), 
				$this->user->get_user_password()
			)
	}
}
