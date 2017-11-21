<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<title>Tin Đất Đai | Đổi mật khẩu</title>
	<?php $this->load->view('common_header')?>
	<?php $this->load->view('/common/googleadsense')?>
</head>
<body>

<div class="container">
	<?php $this->load->view('/theme/header')?>

	<?php $this->load->view('/common/user-menu')?>
	<div class="row no-margin">
		<div class="col-lg-12">
			<div class="col-md-6 well login-panel no-background">
				<div class=" col-xs-12">
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
					$attributes = array("class" => "form-horizontal", "id" => "profile", "name" => "profile");
					echo form_open("doi-mat-khau", $attributes);
					?>
					<fieldset>
						<legend class="text-center">ĐỔI MẬT KHẨU</legend>
						<div class="form-group">
							<div class="row colbox no-margin">
								<div class="col-lg-4 col-sm-4">
									<label for="txt_fullname" class="control-label">Mật khẩu <span class="required">*</span> </label>
								</div>
								<div class="col-lg-8 col-sm-8">
									<input class="form-control" id="txt_oddpw" name="txt_oddpw" placeholder="Mật khẩu" type="password" value="<?=isset($txt_oddpw) ? $txt_oddpw : '' ?>" />
									<span class="text-danger"><?php echo form_error('txt_oddpw'); ?></span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row colbox no-margin">
								<div class="col-lg-4 col-sm-4">
									<label for="txt_email" class="control-label">Mật khẩu mới <span class="required">*</span></label>
								</div>
								<div class="col-lg-8 col-sm-8">
									<input class="form-control" id="txt_newpw" name="txt_newpw" placeholder="Mật khẩu mới" type="password" value="<?=isset($txt_newpw) ? $txt_newpw : '' ?>" />
									<span class="text-danger"><?php echo form_error('txt_newpw'); ?></span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row colbox no-margin">
								<div class="col-lg-4 col-sm-4">
									<label for="txt_phone" class="control-label">Xác nhận lại <span class="required">*</span></label>
								</div>
								<div class="col-lg-8 col-sm-8">
									<input class="form-control" id="txt_newpwconfirm" name="txt_newpwconfirm" placeholder="Nhập lại mật khẩu" type="password" value="<?=isset($txt_newpwconfirm) ? $txt_newpwconfirm : '' ?>" />
									<span class="text-danger"><?php echo form_error('txt_newpwconfirm'); ?></span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-8 col-sm-8 col-lg-offset-4 text-left">
								<input type="hidden" name="crudaction" value="update"/>
								<input id="btn_login" name="btn_login" type="submit" class="btn btn-info" value="Đổi Mật Khẩu" />
							</div>
						</div>

					</fieldset>
					<?php echo form_close(); ?>
				</div>
				<div class="clear-both"></div>

			</div>
		</div>
	</div>

	<?php $this->load->view('/theme/footer')?>
</div>

</body>
</html>
