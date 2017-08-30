<!DOCTYPE html>
<html>
<head>
	<head>
		<meta charset = "utf-8">
		<title>Tin Đất Đai | Đăng Ký</title>
		<?php $this->load->view('common_header')?>
		<?php $this->load->view('/common/googleadsense')?>
	</head>
</head>
<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">
	<?php $this->load->view('/theme/header')?>

	<div class="row no-margin">
		<div class="col-lg-6 col-lg-offset-3 col-sm-6 well login-panel">
			<?php if(!empty($error_response)){
				echo '<div class="alert alert-danger">';
				echo $error_response;
				echo '</div>';
			}?>

			<?php if(!empty($message_response)){
				echo '<div class="alert alert-success">';
				echo '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>';
				echo $message_response;
				echo '</div>';
			}?>

			<?php
				$attributes = array("class" => "form-horizontal", "id" => "register", "name" => "register");
				echo form_open("dang-ky", $attributes);
			?>
			<fieldset>
				<legend class="text-center">ĐĂNG KÝ</legend>
				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_fullname" class="control-label">Họ tên <span class="required">*</span> </label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_fullname" name="txt_fullname" placeholder="Fullname" type="text" value="<?php echo set_value('txt_fullname'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_fullname'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_username" class="control-label">Tên đăng nhập <span class="required">*</span> </label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_username" name="txt_username" placeholder="Username" type="text" value="<?php echo set_value('txt_username'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_username'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_password" class="control-label">Mật khẩu <span class="required">*</span></label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_password" name="txt_password" placeholder="Password" type="password" value="<?php echo set_value('txt_password'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_password'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_email" class="control-label">Email</label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_email" name="txt_email" placeholder="Email" type="text" value="<?php echo set_value('txt_email'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_email'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_phone" class="control-label">Số điện thoại</label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_phone" name="txt_phone" placeholder="Số điện thoại" type="text" value="<?php echo set_value('txt_phone'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_phone'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_address" class="control-label">Địa chỉ</label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_address" name="txt_address" placeholder="Địa chỉ" type="text" value="<?php echo set_value('txt_address'); ?>" />
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-8 col-sm-8 col-lg-offset-4 text-left">
						<input type="hidden" name="crudaction" value="register"/>
						<input id="btn_login" name="btn_login" type="submit" class="btn btn-info" value="Đăng Ký" /> | <a href="<?=base_url('dang-nhap.html')?>">Đăng Nhập</a>
					</div>
				</div>

			</fieldset>
			<?php echo form_close(); ?>
		</div>
	</div>
	<?php $this->load->view('/theme/footer')?>
</div>

</body>
</html>
