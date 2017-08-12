<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Category']);
	}

	public function index()
	{
		$categories = Category::get();
		return $this->twig->display('admin/kategori/index', compact('categories'));
	}

	public function tambah()
	{
		if (!empty($_POST)) {
			Category::create(['name' => ucwords($_POST['name']), 'slug' => str_slug($_POST['name'])]);
			return redirect('manage/kategori');
		}
		return $this->twig->display('admin/kategori/create');
	}

	public function detail($id)
	{
		$category = Category::find($id);
		return $this->twig->display('admin/kategori/tampil', compact('category'));
	}

	public function edit($id)
	{
		$category = Category::find($id);
		if (!empty($_POST)) {
			$category->update(['name' => ucwords($_POST['name']), 'slug' => str_slug($_POST['name'])]);
			return redirect('manage/kategori/detail/' . $category->id);
		}
		return $this->twig->display('admin/kategori/edit', compact('category'));
	}

	public function hapus($id)
	{
		$category = Category::destroy($id);
		return redirect('manage/kategori');
	}
}
