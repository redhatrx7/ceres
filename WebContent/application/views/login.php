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
									'data-required' => true,
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
									'data-required' => true,
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
								<?= anchor('forgot', lang('forgot_password'), array('id' => 'forgot-password-link', 'class' => 'em09 text-primary')) ?>
							</div>
						</div>
						<?= form_close() ?>
						<div id="forgot-form">
							<?= form_open('/login', array('id' => 'forgot-password-form', 'method' => 'post' )); ?>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
									<?= form_input(array(
											'type'			=> 'text',
											'name'			=> 'email',
											'id'			=> 'email',
											'value'			=> set_value('email', $data['email']),
											'class'			=> 'form-control',
											'placeholder'	=> lang('email'),
											'title'			=> form_error('email'),
											'data-toggle'	=> 'tooltip',
											'data-required' => true,
											'data-placement'=> 'top'
									))?>
								</div>
								<div class="form-group row">
									<div class="col">
										<?=form_submit('send_email', lang('send_email'), array(
											'class'	=> 'btn btn-secondary pull-right', 'id' => 'send-email'
										))?>
									</div>
								</div>
								<div class="field-container">  
  <input type="text" class="field" required placeholder="First name"/>
  <label class="floating-label">First name</label> 
  <div class="field-underline"></div>
</div>
<div class="field-container">  
  <input type="text" class="field" required placeholder="Last name"/>
  <label class="floating-label">Last name</label> 
  <div class="field-underline"></div>
</div>
							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Dialogs -->
	<div id="general-dialog" class="modal fade" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?=lang('close') ?></button>
				</div>
			</div>
		</div>
	</div>
</div>