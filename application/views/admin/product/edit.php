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
	<title>Tin Đất Đai | Chỉnh sửa bài đăng</title>
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
				Chỉnh sửa bài đăng <b><?=$product->Title?></b>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li><a href="<?=base_url('/admin/product/list.html')?>">Quản lý bài đăng</a></li>
				<li class="active">Chỉnh sửa bài đăng</li>
			</ol>
		</section>

		<!-- Main content -->
		<?php
		$attributes = array("id" => "frmEditPost");
		echo form_open("admin/product/edit", $attributes);
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
					<h3 class="box-title">Danh sách bài đăng</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="search-filter">
						<div class="row">
							<div class="col-sm-6">
								<label>Tiêu đề</label>
								<div class="form-group">
									<input type="text" name="Title" placeholder="Tiêu đề" class="form-control" value="<?=$product->Title?>" >
								</div>
							</div>
							<div class="col-sm-3">
								<label>Từ ngày</label>
								<div class="form-group">
									<input type="text" name="postFromDate" class="form-control datepicker" id="fromDate" value="<?=$product->FromDate?>">
								</div>
							</div>
							<div class="col-sm-3">
								<label>Đến ngày</label>
								<div class="form-group">
									<input type="text" name="postToDate" class="form-control datepicker" id="toDate" value="<?=$product->ExpireDate?>">
								</div>
							</div>
							<div class="col-sm-3">
								<label>Loại tin rao</label>
								<div class="form-group">
									<select class="form-control" id="sl_category" name="sl_category">
										<option>Chọn loại tin</option>
										<?php
										if($categories != null && count($categories) > 0){
											foreach ($categories as $c){
												if($c->CatType == CAT_TYPE_SALE){?>
													<option value="<?=$c->CategoryID?>" <?=(isset($product->CategoryID) && $product->CategoryID == $c->CategoryID) ? ' selected="selected"' : ''?>><?=$c->CatName?></option>
													<?php
													if(count($child[$c->CategoryID]) > 0){
														foreach ($child[$c->CategoryID] as $k){?>
															<option value="<?=$k->CategoryID?>" <?=((isset($product->CategoryID) && $product->CategoryID == $k->CategoryID) ? ' selected="selected"' : '')?>>&nbsp;&nbsp;&nbsp;&nbsp;<?=$k->CatName?></option>
															<?php
														}
													}
												}
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<label>Ảnh đại diện</label>
								<div class="form-group">
									<input type="text" class="form-control"  name="image_thumb" value="<?=$product->Thumb?>"/>
									<img src="<?=$product->Thumb?>"/>
								</div>
							</div>
							<div class="col-sm-3">
								<label>Gía</label>
								<div class="form-group">
									<input type="text" name="Price" class="form-control" value="<?=$product->Price?>">
								</div>
							</div>
							<div class="col-sm-3">
								<label>Đơn vị</label>
								<select class="form-control" name="txt_unit">
									<?php
									foreach ($units as $ut){
										?>
										<option value="<?=$ut->UnitID?>" <?=(isset($product->Unit) && $product->Unit == $ut->UnitID) ? ' selected': ''?> ><?=$ut->Title?></option>
										<?php
									}
									?>
								</select>
							</div>

						</div>
						<div class="text-center">
							<a class="btn btn-primary" onclick="sendRequest()">Tìm kiếm</a>
						</div>
					</div>

					<div class="row no-margin">
						<a class="btn btn-danger" id="deleteMulti">Xóa Nhiều</a>
					</div>


				</div>
			</div>

		</section>
		<!-- /.content -->
		<input type="hidden" id="crudaction" name="crudaction">
		<input type="hidden" id="productId" name="productId">
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

<script type="text/javascript">
	$(document).ready(function(){

	});
</script>
</body>
</html>
