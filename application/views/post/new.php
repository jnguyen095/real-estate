<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/9/2017
 * Time: 2:19 PM
 */
?>
<!DOCTYPE html>
<html>
<head>
	<head>
		<meta charset = "utf-8">
		<title>Đăng tin rao</title>
		<?php $this->load->view('common_header')?>
</head>
</head>
<body>

<div class="container">
	<?php $this->load->view('/theme/header')?>

	<ul class="breadcrumb">
		<li><a href="<?=base_url('/trang-chu.html')?>">Trang chủ</a> </li>
		<li class="active">Đăng tin rao</li>
	</ul>

	<div class="row no-margin">
		<div class="col-lg-12 col-sm-12">
			<h1 class="h2title">ĐĂNG TIN RAO</h1>
			<hr/>

			<form method="post" action="new.php" enctype="multipart/form-data">
				<div class="form-group">
					<label>Tiêu đề</label>
					<input type="text" id="txt_title" name="txt_title" class="form-control">
					<span class="text-danger"><?php echo form_error('txt_title'); ?></span>
				</div>

				<div class="form-group">
					<div class="col-lg-6 no-padding-left">
						<label>Giá</label>
						<input type="text" id="txt_price" name="txt_price" class="form-control">
						<span class="text-danger"><?php echo form_error('txt_price'); ?></span>
					</div>
					<div class="col-lg-6 no-padding-right">
						<label>Diện tích</label>
						<input type="text" id="txt_area" name="txt_area" class="form-control">
						<span class="text-danger"><?php echo form_error('txt_area'); ?></span>
					</div>
					<div class="clear-both"></div>
				</div>

				<div class="form-group bordered-group">
					<label>Hình đại diện</label>
					<input type="file" id="txt_userfile" name="txt_userfile">
				</div>

				<div class="form-group bordered-group">
					<div class="others-images-container">

					</div>
					<a href="javascript:void(0);" data-toggle="modal" data-target="#modalMoreImages" class="btn btn-info">Upload thêm hình</a>
				</div>
			</form>

			<!-- Modal upload images -->
			<div class="modal fade" id="modalMoreImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							<h4 class="modal-title" id="myModalLabel">Upload thêm hình</h4>
						</div>
						<div class="modal-body">
							<form id="uploadImagesForm">
								<input type="hidden" value="<?=$this->session->userdata('loginid')?>" name="txt_folder">
								<label for="others">Được chọn nhiều hình</label>
								<input type="file" name="others[]" id="others" multiple="">
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-info finish-upload">
								<span class="finish-text" style="display: inline;">Xong</span>
								<img src="<?=base_url('/img/load.gif')?>" class="loadUploadOthers" alt="" style="display: none;">
							</button>
						</div>
					</div>
				</div>
			</div>
			<!-- end modal upload images -->

		</div>
	</div>

	<?php $this->load->view('/theme/footer')?>
</div>

</body>
</html>
