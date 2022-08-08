<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Kasir</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?= base_url('assets/login/images/icons/favicon.ico') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login.css')?>">
</head>

<body style="display: contents;">
	<div class='wrapper' id='wrapper' >
		<div class='card-group' data-active-card='login' id='card-group'>
			<div class='transition-animation' id='transition-animation'></div>
			<div class='card card-login' id='login'>
				<h1 class='title'>LOGIN</h1>
				<hr>
				<form id='login-form' class="login100-form validate-form flex-sb flex-w" method="post" action="<?php echo base_url('index.php') ?>">
					<span class="txt1 p-b-11" style="color: red;">
						<?php if (isset($error)) {
							echo $error;
						}; ?>
					</span>
					<div class='input-group'>
						<input id='name' name='username' onkeyup="this.setAttribute('value', this.value);" type='text' value=''>
						<label for='name'>Username</label>
					</div>
					<?php echo form_error('username'); ?>
					<div class='input-group'>
						<input id='password' name='password' onkeyup="this.setAttribute('value', this.value);" type='password' value=''>
						<label for='password'>Password</label>
					</div>
					<?php echo form_error('password'); ?>
					<button class='btn-default' data-action='submit' type='submit'>Submit <span class="fas fa-arrow-right"></span></button>
				</form>
				<div class='card-footer'>
					<button onclick="window.location='<?php echo base_url('assets/m6_barcode.png') ?>'" class='btn-default btn-invert' data-action='register' id='btn-register' type='javascript:void(0)' style="margin-top: 20px">Barcode Scan <span class="fas fa-check"></span></button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>