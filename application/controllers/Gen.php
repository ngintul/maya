<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager;

class Gen extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		if (!is_cli()) {
			exit("Only CLI");
		}
	}

	public function index()
	{
		$db = new Manager;
		$db->schema()->create('products', function ($t) {
			$t->increments('id');
			$t->integer('cat_id')->nullable();
			$t->string('title');
			$t->string('slug');
			$t->string('image');
			$t->text('detail');
			$t->timestamps();
		});
		return dd('Generate table berhasil');
	}
}