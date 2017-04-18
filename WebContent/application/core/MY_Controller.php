<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->config('controllers/'.strtolower(get_class($this)), FALSE, TRUE);
		$class_config = $this->config->item(strtolower(get_class($this)));

		if ( isset($class_config['header']) )
		{
			$this->load->config('headers/' . $class_config['header'], FALSE, TRUE);
			
		}

		if ( isset($class_config['footer']))
		{
			$this->load->config('footers/'. $class_config['footer'], FALSE, TRUE);
		}
	}

	function _remap( $method )
	{
		$param_offset = 2;
		$verb = strtolower($this->input->server('REQUEST_METHOD'));
		$secondary_method = "{$verb}_{$method}";

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

		if ( count($params) < $r->getNumberOfRequiredParameters())
		{
			header('X-Error-Message: Invalid Request', true, 400);
			die();
		}

		call_user_func_array(array($this, $method), $params);
	}

	protected function show_view( $view, $parameters = array() )
	{
		if (ENVIRONMENT == 'development')
		{
			$class_config = $this->config->item(strtolower(get_class($this)));
			$header_js = array();
			$footer_js = array();
			$css = array();

			if (isset($class_config['header']))
			{
				$css = $this->config->item($class_config['header'])['css'];
				$header_js = $this->config->item($class_config['header'])['js'];
			}
			
			if (isset($class_config['footer']))
			{
				$footer_js = $this->config->item($class_config['footer'])['js'];
			}

			if (isset($class_config))
			{
				if (isset($class_config['css']) AND ! empty($class_config['css']) )
				{
					$css = array_merge($css, $class_config['css']);
				}
	
				if (isset($class_config['js']) AND ! empty($class_config['js']) )
				{
					$footer_js = array_merge($footer_js, $class_config['js']);
				}
			}
		}
		else
		{

			if ( file_exists('assets/css/'.strtolower(get_class($this)).'.min.css') )
			{
				$css = array(asset_url().'css/'.strtolower(get_class($this)).'.min.css');
			}
			$header_js = array();
			$footer_js = array();
			if ( file_exists('assets/js/'.strtolower(get_class($this)).'.min.js') )
			{
				$footer_js = array(asset_url().'js/'.strtolower(get_class($this)).'.min.js');
			}
		}

		$this->load->view('header', array('css' => $css, 'js' => $header_js));
		$this->load->view($view, $parameters);
		$this->load->view('footer', array('js' => $footer_js));
	}
}
