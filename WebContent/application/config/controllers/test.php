<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'test' => array(
		'title' => 'test',
		'meta' => array(
			array('name' => 'description', 'content' => 'this is a test page'),
			array('name' => 'author', 'content' => 'Daniel Demetroulis'),
			array('charset' => 'UTF-8')
		),
		'js' => array(
			asset_url().'js/general/sp_core/*',
			asset_url().'js/general/helper/*',
			asset_url().'js/react/controllers/test/home.js',
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