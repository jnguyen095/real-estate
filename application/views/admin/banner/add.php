<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/3/2017
 * Time: 9:33 AM
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tin Đất Đai | Quản lý trang Banner</title>
	<?php $this->load->view('/admin/common/header-js') ?>
	<link rel="stylesheet" href="<?=base_url('/css/iCheck/all.css')?>">
	<link rel="stylesheet" href="<?=base_url('/admin/css/madmin.css')?>">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<!-- Main Header -->
	<?php $this->load->view('/admin/common/admin-header')?>
	<!-- Left side column. contains the logo and sidebar -->
	<?php $this->load->view('/admin/common/left-menu') ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Thêm/Chỉnh sửa banner
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?=base_url('/admin/dashboard.html')?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li><a href="<?=base_url('/admin/banner/list.html')?>">Quản lý banner</a></li>
				<li class="active">Thêm/Chỉnh sửa</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">
			<?php if(!empty($error_message)){
				echo '<div class="alert alert-danger">';
				echo $error_message;
				echo '</div>';
			}?>
			<div class="box">
				<!-- /.box-header -->
				<div class="box-body">
					<?php
					$attributes = array("id" => "frmAddBanner", "enctype" => "multipart/form-data", "class" => "form-horizontal");
					echo form_open("admin/banner/add", $attributes);
					?>
					<div class="form-group">
						<div class="col-md-2">
							<label>Kiểu banner <span class="required">*</span> </label>
						</div>
						<div class="col-md-4">
							<select name="txt_code" class="form-control">
								<option value="">---Chọn banner---</option>
								<option value="BANNER_HOME_0" <?=(isset($txt_code) && $txt_code == 'BANNER_HOME_0') ? 'selected' : '' ?>>Trang chủ - Top banner(262 x 313px)</option>
								<option value="BANNER_HOME_1" <?=(isset($txt_code) && $txt_code == 'BANNER_HOME_1') ? 'selected' : '' ?>>Trang chủ - Top horizontal banner(1660 x 100px)</option>
								<option value="BANNER_HOME_2" <?=(isset($txt_code) && $txt_code == 'BANNER_HOME_2') ? 'selected' : '' ?>>Trang chủ - Middle horizontal banner(800 x 100px)</option>
								<option value="BANNER_HOME_3" <?=(isset($txt_code) && $txt_code == 'BANNER_HOME_3') ? 'selected' : '' ?>>Trang chủ - Bottom horizontal banner(800 x 100px)</option>
								<option value="BANNER_HOME_4" <?=(isset($txt_code) && $txt_code == 'BANNER_HOME_4') ? 'selected' : '' ?>>Trang chủ - Right banner(336 x 280px)</option>
								<option value="BANNER_CAT_1" <?=(isset($txt_code) && $txt_code == 'BANNER_CAT_1') ? 'selected' : '' ?>>Trang danh mục - Top banner(262 x 313px)</option>
								<option value="BANNER_DETAIL_1" <?=(isset($txt_code) && $txt_code == 'BANNER_DETAIL_1') ? 'selected' : '' ?>>Trang chi tiết - Middle banner(262 x 313px)</option>
							</select>
							<span class="text-danger"><?php echo form_error('txt_code'); ?></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-2">
							<label>Target Url <span class="required">*</span></label>
						</div>
						<div class="col-md-10">
							<input type="text" name="txt_target" class="form-control" value="<?php echo set_value('txt_target', $txt_target); ?>">
							<span class="text-danger"><?php echo form_error('txt_target'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">
							<label>Ưu tiên(nhỏ ưu tiên trước)</label>
						</div>
						<div class="col-md-1">
							<input type="text" name="txt_priority" class="form-control numeric" value="<?php echo set_value('txt_priority', $txt_priority); ?>">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">
							<label>Hiễn thị</label>
						</div>
						<div class="col-md-10">
							<input type="checkbox" name="ch_status" value="1" <?=(set_value('ch_status', $ch_status) == 1) ? "checked" : "" ?> class="form-control minimal">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">
							<label>Ngày hiệu lực</label>
						</div>
						<div class="col-md-2">
							<input type="text" id="txt_fromdate" name="from_date" data-fromdate="" value="<?=isset($from_date) ? $from_date : ''?>" class="form-control from_date">
						</div>
						<div class="col-md-2">
							<input type="text" id="txt_todate" name="to_date" value="<?=isset($to_date) ? $to_date : ''?>" class="form-control to_date">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">
							<label>Hình ảnh <span class="required">*</span></label>
						</div>
						<div class="col-md-10">
							<input type="file" id="txt_image" name="txt_image">
							<span class="text-danger"><?php echo form_error('txt_image'); ?></span>
							<?php
							if(isset($txt_image) && strlen($txt_image) > 0){
								?>
								<img style="width:100%" src="<?=base_url('/img/banner/'.$txt_image)?>"/>
							<?php
							}
							?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-8 col-md-offset-2">
							<a href="<?=base_url('/admin/banner/list.html')?>" class="btn btn-default btn-flat">Trở lại</a>
							<button type="submit" class="btn btn-primary btn-flat">Lưu</button>
						</div>

					</div>
					<input type="hidden" name="BannerID" value="<?=$BannerID?>">
					<input type="hidden" name="preImg" value="<?=$txt_image?>">
					<input type="hidden" name="crudaction" value="insert">
					<?php echo form_close(); ?>
				</div>
			</div>

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<?php $this->load->view('/admin/common/admin-footer')?>

	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>


</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?=base_url('/admin/js/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('/admin/js/bootstrap.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('/admin/js/adminlte.min.js')?>"></script>

<script src="<?=base_url('/admin/js/adminlte.min.js')?>"></script>

<script src="<?=base_url('/ckeditor/ckeditor.js')?>"></script>

<script src="<?=base_url('/css/iCheck/icheck.min.js')?>"></script>

<script src="<?=base_url('/admin/js/bootstrap-datepicker.min.js')?>"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

<script>
	$(function () {
		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass   : 'iradio_minimal-blue'
		});

		$('.from_date').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate: '<?=$from_date?>'
		}).on('changeDate', function (selected) {
			var startDate = new Date(selected.date.valueOf());
			$('.to_date').datepicker('setStartDate', startDate);
		}).on('clearDate', function (selected) {
			$('.to_date').datepicker('setStartDate', null);
		});

		$(".to_date").datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate: '<?=$from_date?>'
		}).on('changeDate', function (selected) {
			var endDate = new Date(selected.date.valueOf());
			$('.from_date').datepicker('setEndDate', endDate);
		}).on('clearDate', function (selected) {
			$('.from_date').datepicker('setEndDate', null);
		});
	})
</script>
</body>
</html>
