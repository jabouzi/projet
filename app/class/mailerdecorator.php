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
		$this->message = sprintf($email,
				$user['user_first_name'],
				$user['user_last_name'],
				implode(', ', $user['user_vhost']),
				$user['user_name'],
				$user['user_password'],
				$user['user_first_name'],
				$user['user_last_name'],
				implode(', ', $user['user_vhost']),
				$user['user_name'],
				$user['user_password']
			);
	}

	public function decorateadmin($user, $email)
	{
		$this->message = sprintf($email,
				$user['first_name'],
				$user['last_name'],
				$user['email'],
				$user['password'],
				$user['first_name'],
				$user['last_name'],
				$user['email'],
				$user['password']
			);
	}

	public function sendusermail($user)
	{
		try {
			$this->mailer = new Mailer();
			$this->mailer->setFrom("TGI", "contact@tonikgrupimage.com");
			$this->mailer->addRecipient($user['user_first_name'].', '.$user['user_last_name'], $user['user_email']);
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
			$this->mailer->addRecipient($user['first_name'].', '.$user['last_name'], $user['email']);
			$this->mailer->fillSubject("Tonik Stagin admin");
			$this->mailer->fillMessage($this->message);
			$this->mailer->addRecipient("Skander Jabouzi", "skander.jabouzi@tonikgroupimage.com");

			// now we send it!
			var_dump($this->mailer->send());
		} catch (Exception $e) {
			echo $e->getMessage();
			exit(0);
		}
	}
}
