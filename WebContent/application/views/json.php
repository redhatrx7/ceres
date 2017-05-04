<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<? header('Content-Type: application/json'); ?>
<?= json_encode($response, TRUE) ?>