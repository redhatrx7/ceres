<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="<?=$language ?>">
<head>
	<? foreach($meta as $tag): ?>
	<meta <? foreach($tag as $type => $component): ?><?=$type.'="'.$component.'" ' ?><? endforeach; ?> >
	<? endforeach; ?>
	<title><?=$title ?></title>

	<? foreach($css as $style): ?>
	<link rel="stylesheet" type="text/css" href="<?=$style ?>" media="screen" />
	<? endforeach; ?>
	<? foreach($js as $script): ?>
	<script src="<?=$script ?>"></script>
	<? endforeach; ?>
</head>
<body>
