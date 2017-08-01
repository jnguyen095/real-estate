<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Form</title>
	<!--link the bootstrap css file-->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

	<style type="text/css">
		.colbox {
			margin-left: 0px;
			margin-right: 0px;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-sm-6">
			<h1>LIVEDOTCOM</h1>
		</div>
		<div class="col-lg-6 col-sm-6">

			<ul class="nav nav-pills pull-right" style="margin-top:20px">
				<li class="active"><a href="#">Login</a></li>
				<li><a href="#">Signup</a></li>
			</ul>

		</div>
	</div>
</div>
<hr/>

<div class="container">
	<div class="row">
		<div class="col-lg-4 col-sm-4 well">
			<?php
			$attributes = array("class" => "form-horizontal", "id" => "loginform", "name" => "loginform");
			echo form_open("login/index", $attributes);?>
			<fieldset>
				<legend>Login</legend>
				<div class="form-group">
					<div class="row colbox">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_username" class="control-label">Username</label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_username" name="txt_username" placeholder="Username" type="text" value="<?php echo set_value('txt_username'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_username'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_password" class="control-label">Password</label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_password" name="txt_password" placeholder="Password" type="password" value="<?php echo set_value('txt_password'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_password'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-12 col-sm-12 text-center">
						<input id="btn_login" name="btn_login" type="submit" class="btn btn-default" value="Login" />
						<input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-default" value="Cancel" />
					</div>
				</div>
			</fieldset>
			<?php echo form_close(); ?>
			<?php echo $this->session->flashdata('msg'); ?>
		</div>
	</div>
</div>

<!--load jQuery library-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--load bootstrap.js-->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
