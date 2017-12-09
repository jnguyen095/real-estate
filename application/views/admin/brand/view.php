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
	<title>Tin Đất Đai | Quản lý dự án</title>
	<?php $this->load->view('/admin/common/header-js') ?>
	<link rel="stylesheet" href="<?=base_url('/admin/css/bootstrap-datepicker.min.css')?>">
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
				Quản lý dự án
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li class="active">Chi tiết dự án</li>
			</ol>
		</section>

		<!-- Main content -->
		<?php
		$attributes = array("id" => "frmPost");
		echo form_open("admin/brand/view", $attributes);
		?>
		<section class="content container-fluid">
			<?php if(!empty($message_response)){
				echo '<div class="alert alert-success">';
				echo '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>';
				echo $message_response;
				echo '</div>';
			}?>
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách dự án</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row no-margin">
						<div class="col-md-2">Tên dự án</div>
						<div class="col-md-10"><?=$brand->BrandName?></div>
					</div>
					<div class="row no-margin">
						<div class="col-md-2">Mô tả ngắn</div>
						<div class="col-md-10"><?=$brand->Description?></div>
					</div>
					<div class="row no-margin">
						<div class="col-md-2">Hình ảnh</div>
						<div class="col-md-10"><img src="<?=$brand->Thumb?>"/></div>
					</div>
					<div class="row no-margin">
						<div class="col-md-2">Hot</div>
						<div class="col-md-10"><?=$brand->Hot?></div>
					</div>
					<div class="row no-margin">
						<div class="col-md-2">BizType</div>
						<div class="col-md-10"><?=$brand->BizType?></div>
					</div>
					<div class="row no-margin">
						<div class="col-md-2">Chủ đầu tư</div>
						<div class="col-md-10"><?=$brand->Owner?></div>
					</div>
					<div class="row no-margin">
						<div class="col-md-2">Tiến trình</div>
						<div class="col-md-10"><?=$brand->Process?></div>
					</div>
					<div class="row no-margin">
						<div class="col-md-2">Diện tích</div>
						<div class="col-md-10"><?=$brand->Area?></div>
					</div>
					<div class="row no-margin">
						<div class="col-md-2">Giá</div>
						<div class="col-md-10"><?=$brand->Price?></div>
					</div>
					<div class="row no-margin">
						<div class="col-md-2">Chi tiết</div>
						<div class="col-md-10"><?=$brand->Detail?></div>
					</div>
					<div class="row no-margin">
						<div class="col-md-2">ngày cập nhật</div>
						<div class="col-md-10"><?=date('d/m/Y H:i', strtotime($brand->ModifiedDate))?></div>
					</div>

					<div class="row no-margin">
						<div class="col-md-2"><a class="btn btn-primary" href="<?=base_url('/admin/brand/list')?>">Trở lại</a></div>
					</div>
				</div>
			</div>

		</section>
		<!-- /.content -->
		<?php echo form_close(); ?>

	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<?php $this->load->view('/admin/common/admin-footer')?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?=base_url('/admin/js/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('/admin/js/bootstrap.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('/admin/js/adminlte.min.js')?>"></script>
<script src="<?=base_url('/js/bootbox.min.js')?>"></script>
<script src="<?=base_url('/admin/js/bootstrap-datepicker.min.js')?>"></script>
<script src="<?=base_url('/admin/js/tindatdai_admin.js')?>"></script>

</body>
</html>
