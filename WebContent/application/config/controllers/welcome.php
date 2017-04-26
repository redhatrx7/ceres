<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'welcome' => array(
		'title' => 'Welcome',
		'meta' => array(
				array('name' => 'description', 'content' => 'this is a welcome page'),
				array('name' => 'author', 'content' => 'Daniel Demetroulis'),
				array('charset' => 'UTF-8')
		),
		'css' => array(
			asset_url().'css/general/codeigniter.css'
		)
	)
);