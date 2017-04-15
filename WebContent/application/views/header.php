<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<? foreach($css as $style): ?>
		<link rel="stylesheet" type="text/css" href="<?=$style ?>" media="screen" />
	<? endforeach; ?>
	<? foreach($js as $script): ?>
	<script src="<?=$script ?>"></script>
	<? endforeach; ?>
</head>
<body>
