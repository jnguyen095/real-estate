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
	<title>Tin Đất Đai | Quản lý trang tĩnh</title>
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
				Thêm/Chỉnh sửa trang tĩnh
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?=base_url('/admin/dashboard.html')?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li><a href="<?=base_url('/admin/static-page/list.html')?>">Quản lý trang tĩnh</a></li>
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
					$attributes = array("id" => "frmAddStaticPage", "class" => "form-horizontal");
					echo form_open("admin/static-page/add", $attributes);
					?>
					<div class="form-group">
						<div class="col-md-2">
							<label>Mã trang <span class="required">*</span> </label>
						</div>
						<div class="col-md-10">
							<input type="text" name="txt_code" class="form-control" value="<?php echo set_value('txt_code', $txt_code); ?>">
							<span class="text-danger"><?php echo form_error('txt_code'); ?></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-2">
							<label>Tiêu đề <span class="required">*</span></label>
						</div>
						<div class="col-md-10">
							<input type="text" name="txt_title" class="form-control" value="<?php echo set_value('txt_title', $txt_title); ?>">
							<span class="text-danger"><?php echo form_error('txt_title'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-2">
							<label>Nội dung <span class="required">*</span></label>
						</div>
						<div class="col-md-10">
						<textarea id="editor1" name="txt_description" class="textarea form-control"><?php echo set_value('txt_description', $txt_description); ?></textarea>
							<span class="text-danger"><?php echo form_error('txt_description'); ?></span>
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
						<div class="col-md-8 col-md-offset-2">
							<a href="<?=base_url('/admin/static-page/list.html')?>" class="btn btn-default btn-flat">Trở lại</a>
							<button type="submit" class="btn btn-primary btn-flat">Lưu</button>
						</div>

					</div>
					<input type="hidden" name="staticPageID" value="<?=$staticPageID?>">
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

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

<script>
	$(function () {
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		//CKEDITOR.replace('editor1')
		CKEDITOR.replace('editor1',{
			toolbar: [
				{ name: 'document', items: [ 'Source', '-', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
				[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
				{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
				{ name: 'styles', items: [ 'Styles', 'Format' ] }
			]
		});

		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass   : 'iradio_minimal-blue'
		})
	})
</script>
</body>
</html>
