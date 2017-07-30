<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Twig
{
	private $paths = [];

	private $config = [

	];

	private $functions_asis = [
		'base_url', 'site_url',  
		'current_url', 'uri_string', 'segment',
	];

	private $functions_safe = [
		'form_open', 'form_close', 'form_error', 'form_hidden', 'set_value',
		'form_open_multipart', 'form_upload', 'form_submit', 'form_dropdown',
		'form_input', 'set_radio',
		'dd', 'dump', 'carbon', 'collect', 'env'
	];

	private $functions_added = FALSE;

	private $twig;

	private $loader;

	public function __construct($params = [])
	{
		if (isset($params['functions']))
		{
			$this->functions_asis =
				array_unique(
					array_merge($this->functions_asis, $params['functions'])
				);
			unset($params['functions']);
		}
		if (isset($params['functions_safe']))
		{
			$this->functions_safe =
				array_unique(
					array_merge($this->functions_safe, $params['functions_safe'])
				);
			unset($params['functions_safe']);
		}

		if (isset($params['paths']))
		{
			$this->paths = $params['paths'];
			unset($params['paths']);
		}
		else
		{
			$this->paths = [VIEWPATH];
		}

		// default Twig config
		$this->config = [
			'cache'      => (ENVIRONMENT === 'production' ? APPPATH . 'cache/twig' : false),
			'debug'      => ENVIRONMENT !== 'production',
			'autoescape' => 'html',
		];

		$this->config = array_merge($this->config, $params);
	}

	protected function resetTwig()
	{
		$this->twig = null;
		$this->createTwig();
	}

	protected function createTwig()
	{
		// $this->twig is singleton
		if ($this->twig !== null)
		{
			return;
		}

		if ($this->loader === null)
		{
			$this->loader = new \Twig_Loader_Filesystem($this->paths);
		}

		$twig = new \Twig_Environment($this->loader, $this->config);

		if ($this->config['debug'])
		{
			$twig->addExtension(new \Twig_Extension_Debug());
		}

		$this->twig = $twig;
	}

	protected function setLoader($loader)
	{
		$this->loader = $loader;
	}

	public function addGlobal($name, $value)
	{
		$this->createTwig();
		$this->twig->addGlobal($name, $value);
	}

	public function display($view, $params = [])
	{
		$CI =& get_instance();
		$CI->output->set_output($this->render($view, $params));
	}

	public function render($view, $params = [])
	{
		$this->createTwig();
		$this->addFunctions();

		$view = $view . '.twig';
		return $this->twig->render($view, $params);
	}

	protected function addFunctions()
	{
		// Runs only once
		if ($this->functions_added)
		{
			return;
		}

		// as is functions
		foreach ($this->functions_asis as $function)
		{
			if (function_exists($function))
			{
				$this->twig->addFunction(
					new \Twig_SimpleFunction(
						$function,
						$function
					)
				);
			}
		}

		// safe functions
		foreach ($this->functions_safe as $function)
		{
			if (function_exists($function))
			{
				$this->twig->addFunction(
					new \Twig_SimpleFunction(
						$function,
						$function,
						['is_safe' => ['html']]
					)
				);
			}
		}

		// customized functions
		if (function_exists('anchor'))
		{
			$this->twig->addFunction(
				new \Twig_SimpleFunction(
					'anchor',
					[$this, 'safe_anchor'],
					['is_safe' => ['html']]
				)
			);
		}

		$this->functions_added = TRUE;
	}

	public function safe_anchor($uri = '', $title = '', $attributes = [])
	{
		$uri = html_escape($uri);
		$title = html_escape($title);

		$new_attr = [];
		foreach ($attributes as $key => $val)
		{
			$new_attr[html_escape($key)] = html_escape($val);
		}

		return anchor($uri, $title, $new_attr);
	}

	public function getTwig()
	{
		$this->createTwig();
		return $this->twig;
	}
}