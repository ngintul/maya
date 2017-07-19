<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Env
{
	protected $_CI;
	
	function __construct()
	{
		$this->_CI =& get_instance();
		$dotenv = new Dotenv\Dotenv(__DIR__ . '/../../');
		$dotenv->load();
	}
}