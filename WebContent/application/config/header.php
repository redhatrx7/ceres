<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
		'header' => array(
			'css' => array (
				asset_url().'css/third_party/jquery-ui.min.css',
				asset_url().'css/third_party/bootstrap-theme.min.css'
			),
			'js' => array(
					asset_url().'js/third_party/jquery.min.js',
					asset_url().'js/third_party/jquery-ui.min.js',
					asset_url().'js/third_party/react-with-addons.min.js',
					asset_url().'js/third_party/react-dom.min.js',
					asset_url().'js/third_party/bootstrap.min.js'
			)
		)
);