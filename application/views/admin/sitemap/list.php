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
	<title>Tin Đất Đai | Quản lý Sitemap</title>
	<?php $this->load->view('/admin/common/header-js') ?>
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
				Quản lý Sitemap
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li class="active">Quản lý Sitemap</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách Sitemap</h3>
				</div>
				<div class="top-buttons">
					<a class="btn btn-info" href="<?=base_url('/admin/sitemap/push.html')?>">Pust lên Search Engine</a>
					<a class="btn btn-primary" href="<?=base_url('/admin/sitemap.html')?>">Tạo sitemap mới</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Cập nhật</th>
								<th>Items</th>
								<th>Ping</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if(isset($sitemaps) && count($sitemaps) > 0) {
							foreach ($sitemaps as $sitemap) {
								?>
								<tr>
									<td><?=$sitemap->SitemapIndexID?></td>
									<td><?=date('d/m/Y H:m:s', strtotime($sitemap->LastModified)) ?></td>
									<td><?=number_format($sitemap->TotalItem)?></td>
									<td><?=$sitemap->Ping == 1 ? '<span class="bg-green-active">Yes</span>': '<span class="bg-danger">No</span>'?></td>
									<td>
										<a href="<?=base_url('/admin/sitemap/view-'.$sitemap->SitemapIndexID.'.html')?>"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;|&nbsp;
										<a href="<?=base_url('/admin/sitemap/sitemap-'.$sitemap->SitemapIndexID.'.html')?>"><i class="glyphicon glyphicon-bookmark"></i></a>
									</td>
								</tr>
								<?php
							}
						}
						?>
						</tbody>
					</table>
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

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>
