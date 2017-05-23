<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div id="signup" class="fill">
	<div class="container-fluid stretch-height">
		<div class="row justify-content-center align-items-center stretch-height">
			<div class="hidden-md-down col col-lg-2 col-md-3"></div>
			<div class="col">
				<div class="card">
					<div class="card-header">
						<?=lang('signup') ?>
					</div>
					<div style="padding-top:30px" class="card-block">
						<?= form_open('/signup', array('id' => 'signup-form', 'method' => 'post' )); ?>
						<div class="input-group">
							<?= form_input(array(
									'type'			=> 'text',
									'name'			=> 'first_name',
									'id'			=> 'first-name',
									'class'			=> 'form-control',
									'placeholder'	=> lang('first_name'),
									'title'			=> form_error('first_name'),
									'value'			=> set_value('first_name', $data['first_name']),
									'data-toggle'	=> 'tooltip',
									'data-required' => true,
									'data-placement'=> 'top'
							))?>
						</div>
						<div class="input-group">
							<?= form_input(array(
									'type'			=> 'text',
									'name'			=> 'last_name',
									'id'			=> 'last-name',
									'class'			=> 'form-control',
									'placeholder'	=> lang('last_name'),
									'title'			=> form_error('last_name'),
									'value'			=> set_value('last_name', $data['last_name']),
									'data-toggle'	=> 'tooltip',
									'data-required' => true,
									'data-placement'=> 'top'
							))?>
						</div>
						<div class="input-group">
							<?= form_input(array(
									'type'			=> 'text',
									'name'			=> 'username',
									'id'			=> 'username',
									'class'			=> 'form-control',
									'placeholder'	=> lang('username'),
									'title'			=> form_error('username'),
									'value'			=> set_value('username', $data['username']),
									'data-toggle'	=> 'tooltip',
									'data-required' => true,
									'data-placement'=> 'top'
							))?>
						</div>
						<div class="input-group">
							<?= form_input(array(
									'type'			=> 'email',
									'name'			=> 'email',
									'id'			=> 'email',
									'class'			=> 'form-control',
									'placeholder'	=> lang('email'),
									'title'			=> form_error('email'),
									'value'			=> set_value('email', $data['email']),
									'data-toggle'	=> 'tooltip',
									'data-required' => true,
									'data-placement'=> 'bottom'
							))?>
						</div>
						<div class="input-group email-confirm">
							<?= form_input(array(
									'type'			=> 'email',
									'name'			=> 'email_confirm',
									'id'			=> 'email-confirm',
									'class'			=> 'form-control',
									'placeholder'	=> lang('email_confirm'),
									'title'			=> form_error('email_confirm'),
									'data-toggle'	=> 'tooltip',
									'data-required' => true,
									'data-placement'=> 'bottom'
							))?>
						</div>
						<div class="input-group">
							<?= form_input(array(
									'type'			=> 'password',
									'name'			=> 'password',
									'id'			=> 'password',
									'class'			=> 'form-control',
									'placeholder'	=> lang('password'),
									'title'			=> form_error('password'),
									'value'			=> set_value('password', $data['password']),
									'data-toggle'	=> 'tooltip',
									'data-required' => true,
									'data-placement'=> 'bottom'
							))?>
						</div>
						<div class="input-group password-confirm">
							<?= form_input(array(
									'type'			=> 'password',
									'name'			=> 'password_confirm',
									'id'			=> 'password-confirm',
									'class'			=> 'form-control',
									'placeholder'	=> lang('password_confirm'),
									'title'			=> form_error('password_confirm'),
									'data-toggle'	=> 'tooltip',
									'data-required' => true,
									'data-placement'=> 'bottom'
							))?>
						</div>
						<div class="date">
							<label><?=lang('birthdate') ?></label>
							<?= form_input(array(
									'type'			=> 'date',
									'name'			=> 'birthdate',
									'id'			=> 'birthdate',
									'min'			=> $data['min_date'],
									'max'			=> date('Y-m-d'),
									'title'			=> form_error('birthdate'),
									'value'			=> set_value('birthdate', $data['birthdate']),
									'data-toggle'	=> 'tooltip',
									'data-required' => true,
									'data-placement'=> 'top'
							))?>
						</div>
						<div class="form-group row create">
							<div class="col">
								<?=form_submit('Complete', lang('register'), array(
									'class'	=> 'btn btn-primary'
								))?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col">
								<?= anchor('login', lang('back'), array('class' => 'em09 text-primary')) ?>
							</div>
						</div>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>