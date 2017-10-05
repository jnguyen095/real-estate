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
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="index2.html" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>TĐĐ</b></span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg">Tin<b> ĐẤT ĐAI</b></span>
		</a>

		<!-- Header Navbar -->
		<?php $this->load->view('/admin/common/admin-header')?>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<?php $this->load->view('/admin/common/left-menu') ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Quản lý trang tĩnh
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li class="active">Quản lý trang tĩnh</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách trang tĩnh</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Mã trang</th>
								<th>Tiêu đề</th>
								<th>Tình trạng</th>
								<th>Lượt xem</th>
								<th>Ngày đăng</th>
								<th>Ngày sửa</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if(isset($staticpages) && count($staticpages) > 0) {
							foreach ($staticpages as $stPage) {
								print_r($stPage->Code);
								?>
								<tr>
									<td><?=$stPage->Code?></td>
									<td><?=$stPage->Title?></td>
									<td><?php
										if($stPage->Status == 1){
											echo '<span class="active">Đang hiển thị</span>';
										}else{
											echo '<span class="block">Bị khóa</span>';
										}
										?>
									</td>
									<td><?=$stPage->View?></td>
									<td><?=date('d/m/Y', strtotime($stPage->CreatedDate)) ?></td>
									<td><?=date('d/m/Y', strtotime($stPage->ModifiedDate)) ?></td>
									<td>
										<a href="<?=base_url('/admin/static-page/add-'.$stPage->StaticPageID.'.html')?>"><i class="	glyphicon glyphicon-edit"></i></a>
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
