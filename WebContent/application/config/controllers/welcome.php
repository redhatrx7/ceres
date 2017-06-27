<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'welcome' => array(
		'title' => 'Welcome',
		'meta' => array(
			array('name' => 'description', 'content' => 'this is a welcome page'),
			array('name' => 'author', 'content' => 'Daniel Demetroulis'),
			array('http-equiv' => 'Content-Type', 'content' + 'text/html', 'charset' => 'UTF-8')
		),
		'css' => array(
			asset_url().'css/controller/welcome.css'
		),
		'js' => array(
			asset_url().'js/general/sp_core/namespace.js',
			asset_url().'js/third_party/jquery.min.js',
			asset_url().'js/general/helper/ajax.js',
			asset_url().'js/general/helper/signout.js',
			asset_url().'js/controllers/welcome/welcome.js'
		)
	)
);