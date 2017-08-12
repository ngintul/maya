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
		switch (env('DB_DRIVER', 'sqlite')) {
			case 'mysql':
				$driver = [
					'driver' => 'mysql',
					'host' => env('DB_HOST', 'localhost'),
					'database'  => env('DB_NAME', 'test'),
					'username' => env('DB_USER', 'root'),
					'password' => env('DB_PASS', ''),
				];
				break;
			case 'sqlite':
				$driver = [
					'driver' => 'sqlite',
					'database' => __DIR__ . '/../../database.sqlite',
				];
				break;
		}
		$capsule = new Capsule;
		$capsule->addConnection($driver);
		$capsule->setAsGlobal();
		$capsule->bootEloquent();
	}
}