<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'login' => array(
		'title' => 'Login',
		'meta' => array(
			array('name' => 'description', 'content' => 'this is the login page'),
			array('name' => 'author', 'content' => 'Daniel Demetroulis'),
			array('http-equiv' => 'Content-Type', 'content' + 'text/html', 'charset' => 'UTF-8')
		),
		'js' => array(
			asset_url().'js/general/sp_core/namespace.js',
			asset_url().'js/general/helper/ajax.js',
			asset_url().'js/controllers/login/login.js'
		),
		'css' => array(
			asset_url().'css/general/content.css',
			asset_url().'css/controller/login.css'
		),
		'header' => 'login_header',
		'footer' => 'footer',
		'validation' => array(
			'login_username' => array(
				array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'required|alpha_dash|xss_clean|trim',
					'errors' => array(
							'required' => 'You must provide a %s.'
					),
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required|xss_clean|trim',
					'errors' => array(
							'required' => 'You must provide a %s.'
					),
				)
			),
			'login_email' => array(
				array(
						'field' => 'username',
						'label' => 'Email',
						'rules' => 'required|valid_email|xss_clean|trim',
						'errors' => array(
								'required' => 'You must provide a %s.'
						),
				),
				array(
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'required|xss_clean|trim',
						'errors' => array(
								'required' => 'You must provide a %s.'
						),
				)
			)
		)
	)
);