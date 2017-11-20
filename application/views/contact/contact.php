<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 11/18/2017
 * Time: 6:16 PM
 */
?>
<!-- Modal -->
<div class="modal-dialog">
	<div class="modal-content">
		<!-- Modal Header -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">
				<span aria-hidden="true">&times;</span>
				<span class="sr-only">Đóng</span>
			</button>
			<h4 class="modal-title h4" id="myModalLabel">Liên Hệ Với Tin Đất Đai</h4>
		</div>

		<!-- Modal Body -->
		<div class="modal-body">
			<p class="statusMsg">Vui lòng để lại thông tin bên dưới!</p>
			<div class="form-group">
				<label for="inputName">Họ tên<span class="required">*</span></label>
				<input name="fullName" type="text" class="form-control" id="fullName" placeholder="Nhập họ tên"/>
				<span class="text-danger"><?php echo form_error('fullName'); ?></span>
			</div>
			<div class="form-group">
				<label for="inputPhone">Số điện thoại<span class="required">*</span></label>
				<input name="phoneNumber" type="text" class="form-control" id="inputPhone" placeholder="Nhập số điện thoại"/>
			</div>
			<div class="form-group">
				<label for="inputEmail">Email</label>
				<input type="email" name="email" class="form-control" id="inputEmail" placeholder="Nhập địa chỉ email"/>
			</div>
			<div class="form-group">
				<label for="inputMessage">Nội dung<span class="required">*</span></label>
				<textarea name="content" class="form-control" id="inputMessage" placeholder="Nhập nội dung"></textarea>
			</div>
			<div class="form-group">
				<label for="inputMessage">Mã xác nhận<span class="required">*</span></label>
				<div class="row">
					<div class="col-md-4">
						<input id="txtCaptcha" name="txt_captcha" class="form-control" value="<?=(isset($txt_captcha) ? $txt_captcha : '')?>"/>
						<span class="text-danger"><?php echo form_error('txt_captcha'); ?></span>
					</div>
					<div class="col-md-8">
						<span id="captchaImg"><?=$capchaImg?></span>
						<a id="changeCaptcha" data-toggle="tooltip" title="Đổi mã xác thực khác" class="margin-left-10"><i class="glyphicon glyphicon-refresh"></i> </a>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Footer -->
		<div class="modal-footer">
			<input type="hidden" name="crudaction" value="insert"/>
			<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			<button id="btnSendFeedBack" type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">Gửi</button>
		</div>
	</div>
</div>
