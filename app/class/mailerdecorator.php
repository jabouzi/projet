<?php

class Mailerdecorator
{
	private $message;
	private $mailer;
	
	function __construct()
	{
		
	}
	
	public function decorateuser($user, $email)
	{
		$this->message = sprintf(
				$email, 
				$user->get_user_first_name(), 
				$user->get_user_last_name(), 
				imlplode(', ', $user->get_user_vhosts()), 
				$user->get_user_name(), 
				$user->get_user_password()
			)
	}
	
	public function decorateadmin($user, $email)
	{
		$this->message = sprintf(
				$email, 
				$user->get_user_first_name(), 
				$user->get_user_last_name(), 
				$user->get_user_name(), 
				$user->get_user_password()
			)
	}
	
	public function sendusermail($user)
	{
		try {
			$this->mailer = new Mailer();
			$this->mailer->setFrom("TGI", "contact@tonikgrupimage.com");
			$this->mailer->addRecipient($user->get_user_first_name().', '.$user->get_user_last_name(), $user->get_user_email());
			$this->mailer->fillSubject("Tonik Stagin website");
			$this->mailer->fillMessage($this->message);			
			$this->mailer->addRecipient("Skander Jabouzi", "skander.jabouzi@tonikgroupimage.com");
			
			// now we send it!
			$this->mailer->send();
		} catch (Exception $e) {
			echo $e->getMessage();
			exit(0);
		}
	}
	
	public function sendadminmail($user)
	{
		try {
			$this->mailer = new Mailer();
			$this->mailer->setFrom("TGI", "contact@tonikgrupimage.com");
			$this->mailer->addRecipient($user->get_first_name().', '.$user->get_last_name(), $user->get_email());
			$this->mailer->fillSubject("Tonik Stagin admin");
			$this->mailer->fillMessage($this->message);			
			$this->mailer->addRecipient("Skander Jabouzi", "skander.jabouzi@tonikgroupimage.com");
			
			// now we send it!
			$this->mailer->send();
		} catch (Exception $e) {
			echo $e->getMessage();
			exit(0);
		}
	}
}
