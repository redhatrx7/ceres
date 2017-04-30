<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Extends the system/core CI_Controller class
 * @author Daniel Demetroulis
 * @reference WebContent/application/config/controllers
 * @reference WebContent/application/config/footers
 * @reference WebContent/application/config/headers
 *
 */
class MY_Controller extends CI_Controller
{
	protected $class_config = array();
	protected $class_name = 'MY_Controller';
	protected $has_header = FALSE;
	protected $has_footer = FALSE;
	protected $language = 'en';

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('directory');
		$this->load->helper('filesystem');

		$this->class_name = strtolower(get_class($this));
		$this->load->config('controllers/' . $this->class_name, FALSE, TRUE);
		$this->load->library('session');
		$this->class_config = $this->config->item($this->class_name);
		$this->has_header = isset($this->class_config['header']);
		$this->has_footer = isset($this->class_config['footer']);
		$this->language = ($this->session->userdata('language')) ? $this->session->userdata('language') : $this->config->item('language');

		// Load class configs
		if ($this->has_header)
		{
			$this->load->config('headers/' . $this->class_config['header']);
		}

		if ($this->has_footer)
		{
			$this->load->config('footers/'. $this->class_config['footer'], FALSE, TRUE);
		}
	}

	/**
	 * remaps controller method call to appropriate method depending on the verb
	 * @param string $method
	 */
	function _remap( $method )
	{
		$param_offset = 2;
		$verb = strtolower($this->input->server('REQUEST_METHOD'));
		$secondary_method = "{$verb}_{$method}";

		// If a method matches the verb change the method
		if (method_exists($this,$secondary_method))
		{
			$method = $secondary_method;
		}

		if ( ! method_exists($this, $method))
		{
			$param_offset = 1;
			$method = 'index';
		}

		$params = array_slice($this->uri->rsegment_array(), $param_offset);
		$r = new \ReflectionMethod($this, $method);

		// If the method request doesnt match the required parameters die
		if (count($params) < $r->getNumberOfRequiredParameters())
		{
			header('X-Error-Message: Invalid Request', true, 400);
			die();
		}

		call_user_func_array(array($this, $method), $params);
	}

	/**
	 * Shows a view based off predetermined header and footer per controller
	 * This method also loads the appropriate js and css files to the header and footer
	 * @param string  $view
	 * @param array $parameters
	 */
	protected function show_view( $view, $parameters = array() )
	{
		$header_js = array();
		$footer_js = array();
		$css = array();
		$title = $this->class_name;
		$meta = array();

		if ($this->has_header)
		{
			if ( ! empty($this->config->item($this->class_config['header'])['external_js']))
			{
				$header_js = $this->config->item($this->class_config['header'])['external_js'];
			}
		}

		// @reference .htaccess
		if (ENVIRONMENT == 'development')
		{
			// This is a development environment: load each css and js individually
			if ($this->has_header)
			{
				if ( ! empty($this->config->item($this->class_config['header'])['css']))
				{
					$css = $this->config->item($this->class_config['header'])['css'];
				}
				
				if ( ! empty($this->config->item($this->class_config['header'])['js']))
				{
					$header_js = array_merge($header_js, $this->config->item($this->class_config['header'])['js']);
				}
				
			}
			
			if ($this->has_footer)
			{
				$footer_js = $this->config->item($this->class_config['footer'])['js'];
			}

			if (isset($this->class_config))
			{
				if (isset($this->class_config['css']) AND ! empty($this->class_config['css']))
				{
					$css = array_merge($css, $this->class_config['css']);
				}
	
				if (isset($this->class_config['js']) AND ! empty($this->class_config['js']) )
				{
					$footer_js = array_merge($footer_js, $this->class_config['js']);
				}
			}

			// if /* is passed get all files in a directory
			$files = array();
			$index_skip = 0;
			foreach( $footer_js as $index => $js_file )
			{
				if (strpos($js_file, '/*') !== false)
				{
					$parts = explode('/', $js_file);
					array_pop($parts);
					$path = implode('/',$parts).'/';
					$map = directory_map('.'.str_replace('/*','',$js_file));
					$files = get_all_files($map, $path);
					array_splice($footer_js, $index+$index_skip, 1, $files);
					$index_skip += sizeof($files)-1;
				}
			}
		}
		else
		{
			// This is not a development environment: load minified css js
			if (file_exists('assets/css/' . $this->class_name . '.min.css'))
			{
				$css = array_merge($css, array(asset_url() . 'css/' . $this->class_name . '.min.css'));
			}

			if (file_exists('assets/js/' . $this->class_name . '.min.js'))
			{
				$footer_js = array(asset_url() . 'js/' . $this->class_name . '.min.js');
			}
		}

		// Set the page title
		if (isset($this->class_config['title']))
		{
			$title = $this->class_config['title'];
		}

		// Set the page meta tags
		if (isset($this->class_config['meta']))
		{
			$meta = $this->class_config['meta'];
		}

		$this->load->view('header', array('css' => $css, 'js' => $header_js, 'title' => $title, 'meta' => $meta, 'language' => $this->language));
		$this->load->view($view, $parameters);
		$this->load->view('footer', array('js' => $footer_js));
	}
}
