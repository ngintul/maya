<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('segment')) {
	function segment($data) 
	{
		$CI =& get_instance();
		return $CI->uri->segment($data);
	}
}

if (! function_exists('carbon')) {
	function carbon()
	{
		return Carbon\Carbon::now();
	}
}
