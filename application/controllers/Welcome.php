<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Product', 'Category', 'Tag']);
	}
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

	public function kategori($slug)
	{
		return $this->twig->display('test');
	}

	public function blog($slug)
	{
		$product =  Product::whereSlug($slug)->first();
		if (is_null($product)) {
			return show_404();
		}
		return $this->twig->display('page/item', compact('product'));
	}

	public function search($value = null)
	{
		# code...
	}
}
