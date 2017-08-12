<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Label extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Tag']);
	}

	public function index()
	{
		$tags = Tag::get();
		return $this->twig->display('admin/label/index', compact('tags'));
	}

	public function tambah()
	{
		if (!empty($_POST)) {
			Tag::create(['name' => ucwords($_POST['name']), 'slug' => str_slug($_POST['name'])]);
			return redirect('manage/label');
		}
		return $this->twig->display('admin/label/create');
	}

	public function detail($id)
	{
		$tag = Tag::find($id);
		return $this->twig->display('admin/label/tampil', compact('tag'));
	}

	public function edit($id)
	{
		$tag = Tag::find($id);
		if (!empty($_POST)) {
			$tag->update(['name' => ucwords($_POST['name']), 'slug' => str_slug($_POST['name'])]);
			return redirect('manage/label/detail/' . $tag->id);
		}
		return $this->twig->display('admin/label/edit', compact('tag'));
	}

	public function hapus($id)
	{
		$tag = Tag::destroy($id);
		return redirect('manage/label');
	}
}
