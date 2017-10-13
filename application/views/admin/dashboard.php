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
	<title>Tin Đất Đai | Dashboard</title>
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
				Page Header
				<small>Optional description</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
				<li class="active">Here</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">

			<!--------------------------
              | Your Page Content Here |
              -------------------------->
			<!-- Info boxes -->
			<div class="row">
				<!-- fix for small devices only -->
				<div class="clearfix visible-sm-block"></div>

				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="info-box">
						<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Thành Viên</span>
							<span class="info-box-number"><?=number_format($totalUser)?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->

				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="info-box">
						<span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Bài Đăng Chính Chủ</span>
							<span class="info-box-number"><?=number_format($totalPost)?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->

				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="info-box">
						<span class="info-box-icon bg-aqua"><i class="fa fa-product-hunt"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Crawler</span>
							<span class="info-box-number"><?=number_format($totalCrawler)?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->

				<!-- /.col -->
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="info-box">
						<span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Subscribe</span>
							<span class="info-box-number"><?=number_format($totalSubscribe)?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->


			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<!-- TABLE: LATEST ORDERS -->
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Đăng nhập hôm nay</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table class="table no-margin">
									<thead>
										<tr>
											<th>#</th>
											<th>Họ Tên</th>
											<th>Username</th>
											<th>Ngày Tạo</th>
											<th>Đăng Nhập</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$index = 1;
									foreach ($loginToday as $user) {
										?>
										<tr>
											<td><?=$index++?></td>
											<td><?=$user->FullName?></td>
											<td><?=$user->UserName?></td>
											<td><?=date('d/m/Y H:i', strtotime($user->CreatedDate))?></td>
											<td><?=date('d/m/Y H:i', strtotime($user->LastLogin))?></td>
										</tr>
										<?php
									}
									if(count($loginToday) < 1){
										echo '<td colspan="5" class="text-center">Không có dữ liệu</td>';
									}
									?>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>
					</div>
					<!-- /.box -->
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<!-- TABLE: LATEST ORDERS -->
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Đăng ký hôm nay</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table class="table no-margin">
									<thead>
									<tr>
										<th>#</th>
										<th>Họ Tên</th>
										<th>Username</th>
										<th>Ngày Tạo</th>
										<th>Đăng Nhập</th>
									</tr>
									</thead>
									<tbody>
									<?php
									$index = 1;
									foreach ($createdToday as $user) {
										?>
										<tr>
											<td><?=$index++?></td>
											<td><?=$user->FullName?></td>
											<td><?=$user->UserName?></td>
											<td><?=date('d/m/Y H:i', strtotime($user->CreatedDate))?></td>
											<td><?=date('d/m/Y H:i', strtotime($user->LastLogin))?></td>
										</tr>
										<?php
									}
									if(count($createdToday) < 1){
										echo '<td colspan="5" class="text-center">Không có dữ liệu</td>';
									}
									?>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>

					</div>
					<!-- /.box -->
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<!-- TABLE: LATEST ORDERS -->
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Bài đăng hôm nay</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table class="table no-margin">
									<thead>
										<tr>
											<th>#</th>
											<th>Tiêu Đề</th>
											<th>Tạo Lúc</th>
											<th>Người Tạo</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$index = 1;
									foreach ($postToday as $post) {
										?>
										<tr>
											<td><?=$index++?></td>
											<td><?=$post->Title?></td>
											<td><?=date('d/m/Y H:i', strtotime($post->PostDate))?></td>
											<td><?=$post->CreatedByID?></td>
										</tr>
										<?php
									}
									if(count($createdToday) < 1){
										echo '<td colspan="4" class="text-center">Không có dữ liệu</td>';
									}
									?>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>

					</div>
					<!-- /.box -->
				</div>

			</div>

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<?php $this->load->view('/admin/common/admin-footer')?>

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Create the tabs -->
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
			<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
			<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<!-- Home tab content -->
			<div class="tab-pane active" id="control-sidebar-home-tab">
				<h3 class="control-sidebar-heading">Recent Activity</h3>
				<ul class="control-sidebar-menu">
					<li>
						<a href="javascript:;">
							<i class="menu-icon fa fa-birthday-cake bg-red"></i>

							<div class="menu-info">
								<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

								<p>Will be 23 on April 24th</p>
							</div>
						</a>
					</li>
				</ul>
				<!-- /.control-sidebar-menu -->

				<h3 class="control-sidebar-heading">Tasks Progress</h3>
				<ul class="control-sidebar-menu">
					<li>
						<a href="javascript:;">
							<h4 class="control-sidebar-subheading">
								Custom Template Design
								<span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
							</h4>

							<div class="progress progress-xxs">
								<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
							</div>
						</a>
					</li>
				</ul>
				<!-- /.control-sidebar-menu -->

			</div>
			<!-- /.tab-pane -->
			<!-- Stats tab content -->
			<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
			<!-- /.tab-pane -->
			<!-- Settings tab content -->
			<div class="tab-pane" id="control-sidebar-settings-tab">
				<form method="post">
					<h3 class="control-sidebar-heading">General Settings</h3>

					<div class="form-group">
						<label class="control-sidebar-subheading">
							Report panel usage
							<input type="checkbox" class="pull-right" checked>
						</label>

						<p>
							Some information about this general settings option
						</p>
					</div>
					<!-- /.form-group -->
				</form>
			</div>
			<!-- /.tab-pane -->
		</div>
	</aside>
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
