<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="container">
	<h1>Welcome</h1>

	<? if (! empty($results)): ?>
	<ul>
		<? foreach($results as $result) : ?>
			<li><?=$result->name ?></li>
		<? endforeach;?>
	</ul>
	<? endif; ?>
	
<?= form_open('/', array('id' => 'form', 'class' => 'test', 'method' => 'get' )); ?>
<?= form_input(array(
        'name'          => 'username',
        'id'            => 'username',
        'value'         => 'johndoe',
        'maxlength'     => '100',
        'size'          => '50',
        'style'         => 'width:50%'
))?>
<?=form_submit('mysubmit', 'Submit Get!')?>
<?= form_close() ?>
<?= form_open('/', array('id' => 'form', 'class' => 'test', 'method' => 'post' )); ?>
<?= form_input(array(
        'name'          => 'username',
        'id'            => 'username',
        'value'         => 'johndoe',
        'maxlength'     => '100',
        'size'          => '50',
        'style'         => 'width:50%'
))?>
<?=form_submit('mysubmit', 'Submit Get!')?>
<?= form_close() ?>

	<div id="body">
		<p>The page you are looking at is being generated.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>User Guide: <a href="user_guide/">User Guide</a>.</p>
	</div>

	<div id="react"></div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>