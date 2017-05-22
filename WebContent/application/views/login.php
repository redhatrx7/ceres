<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div id="login" class="fill">
	<div class="container-fluid stretch-height">
		<div id="language-select" class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="language-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?=lang($language) ?>
			</button>
			<div class="dropdown-menu" aria-labelledby="language-dropdown">
			<? foreach($languages as $lang): ?>
				<?= anchor('login', lang($lang), array('class' => 'dropdown-item ' . (($language === $lang) ? "disabled" : ""), 'data-value' => $lang)) ?>
			<? endforeach; ?>
			</div>
		</div>
		<div class="row justify-content-center align-items-center stretch-height">
			<div class="login-form col col-lg-5 col-md-10 col-sm-12">
				<div class="card">
					<div class="card-header">
						<?=lang('signin') ?>
					</div>
					<div style="padding-top:30px" class="card-block">
						<?= form_open('/login', array('id' => 'login', 'method' => 'post' )); ?>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<?= form_input(array(
									'type'			=> 'text',
									'name'			=> 'username',
									'id'			=> 'username',
									'value'			=> set_value('username', $data['username']),
									'class'			=> 'form-control',
									'placeholder'	=> lang('email_or_username'),
									'title'			=> form_error('username'),
									'data-toggle'	=> 'tooltip',
									'data-placement'=> 'top'
							))?>
						</div>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<?= form_input(array(
									'type'			=> 'password',
									'name'			=> 'password',
									'id'			=> 'password',
									'value'			=> ($data['show_password']) ? set_value('password', $data['password']) : '',
									'class'			=> 'form-control',
									'placeholder'	=> lang('password'),
									'title'			=> form_error('password'),
									'data-toggle'	=> 'tooltip',
									'data-placement'=> 'bottom'
							))?>
						</div>
						<div class="input-group">
							<div class="checkbox">
								<label>
								<?= form_input(array(
									'type'			=> 'checkbox',
									'name'			=> 'remember',
									'id'			=> 'login-remember',
								))?>
								<?=lang('remember_me') ?>
								</label>
							</div>
						</div>
						<div class="form-group row">
							<div class="col">
								<?=form_submit('login', lang('login'), array(
									'class'	=> 'btn btn-primary'
								))?>
							</div>
							<div class="col col-md-auto align-self-center">
								<?= anchor('signup', lang('register'), array('class' => 'em09 text-primary')) ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col">
								<?= anchor('forgot', lang('forgot_password'), array('class' => 'em09 text-primary')) ?>
							</div>
						</div>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>