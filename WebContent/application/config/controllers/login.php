<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'login' => array(
		'title' => 'Login',
		'meta' => array(
			array('name' => 'description', 'content' => 'this is the login page'),
			array('name' => 'author', 'content' => 'Daniel Demetroulis'),
			array('charset' => 'UTF-8')
		),
		'js' => array(
		),
		'css' => array(
			asset_url().'css/general/content.css',
			asset_url().'css/controller/login.css'
		),
		'header' => 'login_header',
		'footer' => 'footer'
	)
);