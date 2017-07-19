<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Container\Container;

class Orm
{
	protected $_CI;
	
	function __construct()
	{
		$this->_CI =& get_instance();
		$capsule = new Capsule;
		$capsule->addConnection([
			'driver' => env('DB_DRIVER', 'mysql'),
			'host' => env('DB_HOST', 'localhost'),
			'database'  => env('DB_NAME', ''),
			'username' => env('DB_USER', 'root'),
			'password' => env('DB_PASS', ''),
		]);
		$capsule->setAsGlobal();
		$capsule->bootEloquent();
	}
}