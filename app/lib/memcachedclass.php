<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Memcachedclass {

	private $_memcached;

	private $_memcache_conf = array(
					'default_host'		=> '127.0.0.1',
					'default_port'		=> 11211,
					'default_weight'	=> 1
				);

	function __construct()
	{
		$this->_memcached = new Memcached();
		$this->_memcached->addServer($this->_memcache_conf['hostname'], $this->_memcache_conf['port'], $this->_memcache_conf['weight']);
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

}

