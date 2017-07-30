<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{

	public function index()
	{
		return $this->twig->display('page/index');
	}

	public function produk()
	{
		return $this->twig->display('page/produk');
	}

	public function galeri()
	{
		return $this->twig->display('page/galeri');
	}

	public function tentang()
	{
		return $this->twig->display('page/about');
	}

	public function blog()
	{
		return $this->twig->display('page/item');
	}
}
