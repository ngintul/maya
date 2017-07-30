<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola extends CI_Controller 
{

	public function index()
	{
		return $this->twig->display('page/index');
	}

	public function produk()
	{
		return dd('Produk');
	}

	public function galeri()
	{
		return dd('Galeri');
	}

	public function tentang()
	{
		return dd('Tentang');
	}
}
