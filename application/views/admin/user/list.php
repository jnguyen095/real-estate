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
	<title>Tin Đất Đai | Quản lý người dùng</title>
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
				Quản lý người dùng
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li class="active">Quản lý người dùng</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách người dùng</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row search-filter">
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" name="searchFor" placeholder="Tìm theo tên, số điện thoại, email, địa chỉ..." class="form-control" id="searchKey" onchange="sendRequest();">
							</div>
						</div>
					</div>

					<table class="admin-table table table-bordered table-striped">
						<thead>
							<tr>
								<th></th>
								<th data-action="sort" data-title="FullName" data-direction="ASC"><span>Họ Tên</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="UserName" data-direction="ASC"><span>Username</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="Phone" data-direction="ASC"><span>Số Điện Thoại</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="Email" data-direction="ASC"><span>Email</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="Address" data-direction="ASC"><span>Địa Chỉ</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="CreatedDate" data-direction="ASC"><span>Ngày Tạo</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="LastLogin" data-direction="ASC"><span>Lần Cuối Đăng Nhập</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$counter = 1;
						foreach ($users as $user) {
							?>
							<tr>
								<td><?=$counter++?></td>
								<td><?=$user->FullName?></td>
								<td><?=$user->UserName?></td>
								<td><?=$user->Phone?></td>
								<td><?=$user->Email?></td>
								<td><?=$user->Address?></td>
								<td><?=date('d/m/Y H:i', strtotime($user->CreatedDate))?></td>
								<td><?=date('d/m/Y H:i', strtotime($user->LastLogin))?></td>
								<td>
									<a data-toggle="tooltip" title="Xem tin rao"><i class="glyphicon glyphicon-folder-open"></i></a>&nbsp;|
									<a data-toggle="tooltip" title="Chỉnh sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;|
									<a data-toggle="tooltip" title="Xóa Người dùng"><i class="glyphicon glyphicon-remove"></i></a>
								</td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
					<div class="text-center">
						<?php echo $pagination; ?>
					</div>
				</div>
			</div>

		</section>
		<!-- /.content -->
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

<script src="<?=base_url('/admin/js/tindatdai_admin.js')?>"></script>

<script type="text/javascript">
	admin_paging('<?=base_url('admin/user/list.html')?>');
</script>
</body>
</html>