<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
	public function __construct($config = array())
	{
		parent::__construct($config);
	}

	function set_post_validation_error($field, $lang)
	{
		if( ! isset($this->_field_data[$field]))
		{
			$this->_field_data[$field]['postdata'] = '';
		}

		$this->_field_data[$field]['error'] = $this->CI->lang->line('form_validation_'.$lang);
		
		if ( ! isset($this->_error_array[$field]))
		{
			$this->_error_array[$field] = $this->CI->lang->line('form_validation_'.$lang);
		}
	}
}
