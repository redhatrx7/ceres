<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'signup' => array(
		'title' => 'Create Account',
		'meta' => array(
			array('name' => 'description', 'content' => 'this is the signup apge'),
			array('name' => 'author', 'content' => 'Daniel Demetroulis'),
			array('http-equiv' => 'Content-Type', 'content' + 'text/html', 'charset' => 'UTF-8')
		),
		'js' => array(
			asset_url().'js/general/sp_core/namespace.js',
			asset_url().'js/general/helper/ajax.js',
		),
		'css' => array(
			asset_url().'css/general/content.css',
				asset_url().'css/controller/signup.css'
		),
		'header' => 'basic_header',
		'footer' => 'footer'
	)
);