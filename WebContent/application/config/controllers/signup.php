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
			asset_url().'js/general/helper/tooltip.js',
			asset_url().'js/controllers/signup/signup.js',
		),
		'css' => array(
			asset_url().'css/general/content.css',
				asset_url().'css/controller/signup.css'
		),
		'header' => 'basic_header',
		'footer' => 'footer',
		'validation' => array(
			array(
					'field' => 'first_name',
					'label' => 'First Name',
					'rules' => 'required|alpha|xss_clean|trim|max_length[50]|min_length[2]',
					'errors' => array(
							'required' => 'You must provide a %s.'
					),
			),
			array(
					'field' => 'last_name',
					'label' => 'Last Name',
					'rules' => 'required|alpha|xss_clean|trim|max_length[50]|min_length[2]',
					'errors' => array(
							'required' => 'You must provide a %s.'
					),
			),
			array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'required|alpha_dash|xss_clean|trim|is_unique[user.username]|max_length[15]|min_length[4]',
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
			),
			array(
					'field' => 'password_confirm',
					'label' => 'Confirmed Password',
					'rules' => 'required|xss_clean|trim|matches[password]',
					'errors' => array(
							'required' => 'You must provide a %s.'
					),
			),
			array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|valid_email|xss_clean|trim|is_unique[user.email]',
					'errors' => array(
							'required' => 'You must provide a %s.'
					),
			),
			array(
					'field' => 'email_confirm',
					'label' => 'Confirmed Email',
					'rules' => 'required|xss_clean|trim|matches[email]',
					'errors' => array(
							'required' => 'You must provide a %s.'
					),
			),
			array(
					'field' => 'birthdate',
					'label' => 'Birthdate',
					'rules' => 'required|xss_clean|trim',
					'errors' => array(
							'required' => 'You must provide a %s.'
					),
			),
		)
	)
);