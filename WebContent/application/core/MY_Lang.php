<?php defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Lang extends CI_Lang {

	public function __construct()
	{
		parent::__construct();
	}

	public function line($line, $log_errors = TRUE)
	{
		$value = isset($this->language[$line]) ? $this->language[$line] : FALSE;

		// Because killer robots like unicorns!
		if ($value === FALSE && $log_errors === TRUE)
		{
			log_message('error', 'Could not find the language line "'.$line.'"');
		}

		return utf8_encode($value);
	}

}
