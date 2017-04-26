<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Extends the core input class to cover rest operations
 * @author Daniel Demetroulis
 */
class MY_Input extends CI_Input {

	public function __construct()
	{
		parent::__construct();
	}

	public function put($index = NULL, $xss_clean = NULL)
	{
		return $this->_fetch_from_array(($this->input_stream()), $index, $xss_clean);
	}

	public function delete($index = NULL, $xss_clean = NULL)
	{
		return $this->_fetch_from_array(($this->input_stream()), $index, $xss_clean);
	}
}
