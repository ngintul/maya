<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komentar extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return $this->twig->display('admin/label/index');
	}

	public function simpan()
	{
		return dd('Kategori');
	}

	public function detail()
	{
		return $this->twig->display('admin/label/detail');
	}

	public function edit()
	{
		return $this->twig->display('admin/label/edit');
	}

	public function update()
	{
		return redirect();
	}

	public function hapus($id)
	{
		return redirect();
	}
}
