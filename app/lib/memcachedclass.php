<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Memcachedclass {

	private $_memcached;

	private $_memcache_conf = array(
					'host'		=> '127.0.0.1',
					'port'		=> 11211,
					'weight'	=> 1
				);

	function __construct()
	{
		$this->_memcached = new Memcached();
		var_dump($this->_memcached->getServerList());
		$this->_memcached->connect($host , $port, $weight)($this->_memcache_conf['host'], $this->_memcache_conf['port'], $this->_memcache_conf['weight']);
	}

	public function get($id)
	{
		$data = $this->_memcached->get($id);

		return (is_array($data)) ? $data[0] : FALSE;
	}

	public function save($id, $data, $ttl = 0)
	{
		return $this->_memcached->set($id, array($data, time(), $ttl), $ttl);
	}

	public function delete($id)
	{
		return $this->_memcached->delete($id);
	}

	public function clean()
	{
		return $this->_memcached->flush();
	}

	public function cache_info($type = NULL)
	{
		return $this->_memcached->getStats();
	}

	public function get_metadata($id)
	{
		$stored = $this->_memcached->get($id);

		if (count($stored) !== 3)
		{
			return FALSE;
		}

		list($data, $time, $ttl) = $stored;

		return array(
			'expire'	=> $time + $ttl,
			'mtime'		=> $time,
			'data'		=> $data
		);
	}
	
	public function connect($host , $port, $weight){ 
		$servers = $this->_memcached->getServerList(); 
		if(is_array($servers)) { 
			foreach ($servers as $server) if($server['host'] == $host and $server['port'] == $port) return true; 
		} 
		return $this->_memcached->addServer($host , $port, $weigh); 
	} 

}

