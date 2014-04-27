<?php

class Encryption 
{
	function __construct()
    {

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

	function encrypt($object)
	{
		$message = json_encode($object);
		$key = md5('mysqlauth');
		$pstr = $this->pkcs5Pad($message, 16);
		$cstr = $this->getEncrypt($pstr, pack("H*", $key));
		$string = urlencode($cstr);
		return $string;
	}

	function decrypt($string)
	{
		$key = md5('mysqlauth');
		$dstr = $this->getDecrypt(urldecode($string), pack("H*", $key));
		$object = json_decode($this->pkcs5Unpad($dstr, 16));
		return $object;
	}
}
