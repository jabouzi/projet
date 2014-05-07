<?php

class Mailerdecorator
{
	private $user;
	private $message;
	
	function __construct($user)
	{
		$this->user = $user;
	}
	
	public function decorate($email)
	{
		$this->message = sprintf(
				$email, 
				$this->user->get_user_first_name(), 
				$this->user->get_user_last_name(), 
				imlplode(', ', $this->user->get_user_vhosts()), 
				$this->user->get_user_name(), 
				$this->user->get_user_password()
			)
	}
	
	public function sendmail()
	{
		try {
			$dummy = new Mailer();
			$dummy->setFrom("TGI", "contact@tonikgrupimage.com");
			$dummy->addRecipient($this->user->get_user_first_name().', '.$this->user->get_user_last_name(), $this->user->get_user_email());
			$dummy->fillSubject("Tonik Stagin website");
			$dummy->fillMessage($this->message);			
			$dummy->addRecipient("Skander Jabouzi", "skander.jabouzi@tonikgroupimage.com");
			
			// now we send it!
			$dummy->send();
		} catch (Exception $e) {
			echo $e->getMessage();
			exit(0);
		}
	}
}
