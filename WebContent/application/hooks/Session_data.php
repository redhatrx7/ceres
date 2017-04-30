<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SessionData{
    var $CI;

    function __construct(){
        $this->CI =& get_instance();
    }

    function initializeData() {
          if(!$this->CI->session->userdata('language')){
          	$this->CI->session->set_userdata('language', $this->CI->config->item('language'));
             $this->CI->session->set_userdata('user', array());
          }
    }
}
