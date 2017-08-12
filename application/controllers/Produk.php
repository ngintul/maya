<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Product', 'Category', 'Tag']);
	}

	public function index()
	{
		$products = Product::get();
		return $this->twig->display('admin/produk/index', compact('products'));
	}

	public function tambah()
	{
		if (!empty($_POST)) {
			$_POST['slug'] = str_slug($_POST['title']);
			foreach ($_POST['tag'] as $key => $value) {
				$data = Tag::whereSlug(str_slug($value))->first();
				if ($data) {
					$tags[] = $data->id;
				} else {
					$data = Tag::create(['name' => ucwords($value), 'slug' => str_slug($value)]);
					$tags[] = $data->id;
				}
			}
			$product = Product::create($_POST);
			$product->tags()->sync(is_array($tags) ? $tags : [], false);
			return redirect('manage/produk');
		}
		$categories = Category::get();
		$tags = Tag::get();
		return $this->twig->display('admin/produk/create', compact('categories', 'tags'));
	}

	public function detail($id)
	{
		$product = Product::find($id);
		return $this->twig->display('admin/produk/tampil', compact('product'));
	}

	public function edit($id)
	{
		$product = Product::find($id);
		if (!empty($_POST)) {
			$_POST['title'] = ucwords($_POST['title']);
			$_POST['slug'] = str_slug($_POST['title']);
			foreach ($_POST['tag'] as $key => $value) {
				$data = Tag::whereSlug(str_slug($value))->first();
				if ($data) {
					$tags[] = $data->id;
				} else {
					$data = Tag::create(['name' => ucwords($value), 'slug' => str_slug($value)]);
					$tags[] = $data->id;
				}
			}
			$product->update($_POST);
			$product->tags()->sync(is_array($tags) ? $tags : []);
			return redirect('manage/produk/detail/' . $product->id);
		}
		$categories = Category::get();
		$tags = Tag::get();
		return $this->twig->display('admin/produk/edit', compact('product', 'categories', 'tags'));
	}

	public function hapus($id)
	{
		$product = Product::destroy($id);
		return redirect('manage/produk');
	}
}
