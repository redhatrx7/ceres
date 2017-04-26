<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div id="content" class="fill">
	<div class="container stretch-height">
		<div class="row justify-content-center align-items-center stretch-height">
			<div class="login-form col-8">
				<div class="card">
					<div class="card-header">
						Sign In
					</div>
					<div style="padding-top:30px" class="card-block">
						<?= form_open('/', array('id' => 'login', 'class' => 'test', 'method' => 'post' )); ?>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							
							<?= form_input(array(
									'type'			=> 'text',
							        'name'          => 'username',
							        'id'            => 'username',
									'class'			=> 'form-control',
									'placeholder'	=> 'username or email',
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
									'class'			=> 'btn btn-success'
							))?>
						</div>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>