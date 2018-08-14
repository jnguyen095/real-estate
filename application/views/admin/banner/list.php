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
				Quản lý trang Banner
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li class="active">Quản lý trang banner</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách banner</h3>
				</div>

				<?php if(!empty($message_response)){
					echo '<div class="alert alert-success">';
					echo '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>';
					echo $message_response;
					echo '</div>';
				}?>

				<?php
				$attributes = array("id" => "frmBanner");
				echo form_open("admin/banner/list", $attributes);
				?>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="top-buttons"><a class="btn btn-primary" href="<?=base_url('/admin/banner/add.html')?>">Thêm Mới</a> </div>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Loại banner</th>
								<th>Target Url</th>
								<th>Lượt click</th>
								<th>Status</th>
								<th>Từ ngày</th>
								<th>Đến ngày</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if(isset($banners) && count($banners) > 0) {
							foreach ($banners as $banner) {
								?>
								<tr>
									<td><?=$banner->Code?></td>
									<td><?=$banner->TargetUrl?></td>
									<td><?=$banner->Click?></td>
									<td><?php
										if($banner->Status == 1){
											echo '<span class="active">Đang hiển thị</span>';
										}else{
											echo '<span class="block">Bị khóa</span>';
										}
										?>
									</td>
									<td><?=date('d/m/Y', strtotime($banner->FromDate)) ?></td>
									<td><?=date('d/m/Y', strtotime($banner->ToDate)) ?></td>
									<td>
										<a href="<?=base_url('/admin/banner/add-'.$banner->BannerID.'.html')?>" data-toggle="tooltip" title="Chỉnh sửa"><i class="	glyphicon glyphicon-edit"></i></a>&nbsp;|&nbsp;
										<a href="<?=base_url('/admin/banner/analytic-'.$banner->BannerID.'.html')?>" data-toggle="tooltip" title="Xem thống kê"><i class="glyphicon glyphicon-list-alt"></i></a>&nbsp;|&nbsp;
										<a href="#" class="remove-post" data-post="<?=$banner->BannerID?>" data-toggle="tooltip" title="Xóa banner"><span class="glyphicon glyphicon-remove"></span></a>
									</td>
								</tr>
								<?php
							}
						}
						?>
						</tbody>
					</table>
					<div class="text-center">
						<?php echo $pagination; ?>
					</div>
				</div>
				<input type="hidden" id="crudaction" name="crudaction">
				<input type="hidden" id="bannerId" name="bannerId">
				<?php echo form_close(); ?>
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
<script src="<?=base_url('/js/bootbox.min.js')?>"></script>

<script type="text/javascript">
	$(document).ready(function(){
		deletePostHandler();
	});
	function deletePostHandler(){
		$('.remove-post').click(function(){
			var prId = $(this).data('post');
			bootbox.confirm("Bạn đã chắc chắn xóa banner này chưa?", function(result){
				if(result){
					$("#bannerId").val(prId);
					$("#crudaction").val("delete");
					$("#frmBanner").submit();
				}
			});
		});
	}
</script>
</body>
</html>
