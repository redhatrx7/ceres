<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'test' => array(
		'js' => array(
			asset_url().'js/general/sp_core/*',
			asset_url().'js/react/controllers/test.js',
			asset_url().'js/controllers/test/*'
			
		),
		'css' => array(
			asset_url().'css/general/codeigniter.css',
			asset_url().'css/controller/test.css'
		),
		'header' => 'header',
		'footer' => 'footer'
	)
);