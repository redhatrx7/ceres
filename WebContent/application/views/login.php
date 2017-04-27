<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div id="login" class="fill">
	<div class="container stretch-height">
		<div class="row justify-content-center align-items-center stretch-height">
			<div class="login-form col-8">
				<div class="card">
					<div class="card-header">
						Sign In
					</div>
					<div style="padding-top:30px" class="card-block">
						<?= form_open('/login', array('id' => 'login', 'class' => 'test', 'method' => 'post' )); ?>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<?= form_input(array(
									'type'			=> 'text',
							        'name'          => 'username',
							        'id'            => 'username',
									'value'			=> set_value('username'),
									'class'			=> 'form-control',
									'placeholder'	=> 'username or email',
									'required'		=> 'required',
									'title'			=> form_error('username'),
									'data-toggle'	=> 'tooltip'
							))?>
						</div>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<?= form_input(array(
									'type'			=> 'password',
							        'name'          => 'password',
							        'id'            => 'password',
									'class'			=> 'form-control',
									'placeholder'	=> 'password',
									'required'		=> 'required',
									'title'			=> form_error('password'),
									'data-toggle'	=> 'tooltip'
							))?>
						</div>
						<div class="input-group">
							<div class="checkbox">
								<label>
								<?= form_input(array(
									'type'			=> 'checkbox',
							        'name'          => 'remember',
							        'id'            => 'login-remember',
								))?>
								Remember me
								</label>
							</div>
						</div>
						<div class="form-group">
							<?=form_submit('login', 'Login', array(
									'class'			=> 'btn btn-primary'
							))?>
						</div>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>