<?php

class Encryption 
{
	function __construct()
    {
        require_once('view.php');
        require_once('model.php');
    }

	function encrypt($input,$ky)
	{
	   $key = $ky;
	   $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
	   $input = $this->pkcs5Pad($input, $size);
	   $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
	   $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	   mcrypt_generic_init($td, $key, $iv);
	   $data = mcrypt_generic($td, $input);
	   mcrypt_generic_deinit($td);
	   mcrypt_module_close($td);
	   $data = base64_encode($data);
	   $data = urlencode($data); //push it out so i can check it works
	   return $data;
	}

	function getEncrypt($sStr, $sKey) {
	  return base64_encode(
		mcrypt_encrypt(
			MCRYPT_RIJNDAEL_128, 
			$sKey,
			$sStr,
			MCRYPT_MODE_ECB
		)
	  );
	}

	function getDecrypt($sStr, $sKey) {
		return mcrypt_decrypt(
			MCRYPT_RIJNDAEL_128, 
			$sKey,
			base64_decode($sStr), 
			MCRYPT_MODE_ECB
		);
	}

	function pkcs5Pad ($text, $blocksize) { 
	  $pad = $blocksize - (strlen($text) % $blocksize); 
	  return $text . str_repeat(chr($pad), $pad); 
	}

	function pkcs5Unpad($text, $blocksize)
	{
	   $pad = ord($text{strlen($text)-1});
	   if ($pad > strlen($text)) return false;
	   return substr($text, 0, -1 * $pad);
	}

	function encryptUrl($object)
	{
		$message = json_encode($object);
		$key = md5('promokey');
		$pstr = $this->pkcs5Pad($message, 16);
		$cstr = $this->getEncrypt($pstr, pack("H*", $key));
		$string = urlencode($cstr);
		return $string;
	}

	function decryptUrl($string)
	{
		$key = md5('promokey');
		$dstr = $this->getDecrypt(urldecode($string), pack("H*", $key));
		$object = json_decode($this->pkcs5Unpad($dstr, 16));
		return $object;
	}
}
