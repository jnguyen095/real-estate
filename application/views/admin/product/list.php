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
	<title>Tin Đất Đai | Quản lý bài đăng</title>
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
				Quản lý bài đăng <?=isset($user) ? 'của:<b> '.$user->FullName.' - '.$user->Phone.'</b>': ''?>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li class="active">Quản lý bài đăng</li>
			</ol>
		</section>

		<!-- Main content -->
		<?php
		$attributes = array("id" => "frmPost");
		echo form_open("admin/product/list", $attributes);
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
									<input type="text" name="searchFor" placeholder="Tìm tiêu đề" class="form-control" id="searchKey">
								</div>
							</div>
							<div class="col-sm-2">
								<label>Số điện thoại</label>
								<div class="form-group">
									<input type="text" name="phoneNumber" class="form-control" id="phoneNumber">
								</div>
							</div>
							<div class="col-sm-2">
								<label>Từ ngày</label>
								<div class="form-group">
									<input type="text" name="postFromDate" class="form-control datepicker" id="fromDate">
								</div>
							</div>
							<div class="col-sm-2">
								<label>Đến ngày</label>
								<div class="form-group">
									<input type="text" name="postToDate" class="form-control datepicker" id="toDate">
								</div>
							</div>
							<div class="col-sm-2">
								<label>Mã tin(ID)</label>
								<div class="form-group">
									<input type="text" name="code" class="form-control" id="code">
								</div>
							</div>
							<div class="col-sm-3">
								<label>Loại tin</label>
								<div class="form-group">
									<label><input id="chb-0" checked="checked" type="radio" name="hasAuthor" value="-1"> Tất cả</label>
									<label><input id="chb-2" type="radio" name="hasAuthor" value="1"> Chính chủ</label>
									<label><input id="chb-1" type="radio" name="hasAuthor" value="0"> Crawler</label>
								</div>
							</div>
							<div class="col-sm-4">
								<label>Tình trạng</label>
								<div class="form-group">
									<label><input id="st_0" checked="checked" type="radio" name="status" value="-1"> Tất cả</label>
									<label><input id="st-1" type="radio" name="status" value="1"> Hoạt động</label>
									<label><input id="st-0" type="radio" name="status" value="0"> Tạm dừng</label>
									<label><input id="st-2" type="radio" name="status" value="2"> Chờ thanh toán</label>
								</div>
							</div>
						</div>
						<div class="text-center">
							<a class="btn btn-primary" onclick="sendRequest()">Tìm kiếm</a>
						</div>
					</div>

					<div class="row no-margin">
						<a class="btn btn-danger" id="deleteMulti">Xóa Nhiều</a>
					</div>

					<div class="table-responsive">
						<table class="admin-table table table-bordered table-striped">
							<thead>
								<tr>
									<th><input name="checkAll" value="1" type="checkbox" ></th>
									<th data-action="sort" data-title="Title" data-direction="ASC"><span>Tiêu đề</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
									<th data-action="sort" data-title="Status" data-direction="ASC"><span>Status</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
									<th data-action="sort" data-title="Vip" data-direction="ASC"><span>Loại tin</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
									<th data-action="sort" data-title="View" data-direction="ASC"><span>Lượt xem</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
									<th data-action="sort" data-title="PostDate" data-direction="ASC"><span>Ngày đăng</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
									<th data-action="sort" data-title="ExpireDate" data-direction="ASC"><span>Hết hạn</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
									<th data-action="sort" data-title="ModifiedDate" data-direction="ASC"><span>Cập nhật</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
									<th data-action="sort" data-title="CreatedByID" data-direction="ASC"><span>Người đăng</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
									<th data-action="sort" data-title="IpAddress" data-direction="ASC"><span>Ip Address</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
									<th></th>
								</tr>
							</thead>
							<tbody>

							<?php
							$counter = 1;
							foreach ($products as $product) {
								?>
								<tr>
									<td><input name="checkList[]" type="checkbox" value="<?=$product->ProductID?>"></td>
									<td><a class="vip<?=$product->Vip?>" data-toggle="tooltip" title="<?=$product->Title?>" href="<?=base_url(seo_url($product->Title).'-p').$product->ProductID.'.html'?>"><?=substr_at_middle($product->Title, 60)?></a></td>
									<td>
										<?php
											if($product->Status == ACTIVE){
												echo '<span class="label label-success">Show</span>';
											}else if($product->Status == PAYMENT_DELAY){
												echo '<span class="label label-info">Payment</span>';
											} else{
												echo '<span class="label label-danger">Hide</span>';
											}
										?>
									</td>
									<td>
										<select onchange="updateVip('<?=$product->ProductID?>', this.value);">
											<option value="0" <?=$product->Vip == 0 ? ' selected' : ''?>>Vip 0</option>
											<option value="1" <?=$product->Vip == 1 ? ' selected' : ''?>>Vip 1</option>
											<option value="2" <?=$product->Vip == 2 ? ' selected' : ''?>>Vip 2</option>
											<option value="3" <?=$product->Vip == 3 ? ' selected' : ''?>>Vip 3</option>
											<option value="5" <?=$product->Vip == 5 ? ' selected' : ''?>>Thường</option>
										</select>
									</td>
									<td class="text-right">
										<?php
										if(isset($product->FullName)) {
											?>
											<input class="txtView" id="pr-<?=$product->ProductID?>" type="text" value="<?= $product->View?>"
												   onchange="updateView('<?=$product->ProductID?>', this.value);"/>
											<?php
										}else{
											echo $product->View;
										}
										?>
									</td>
									<td><?=date('d/m/Y H:i', strtotime($product->PostDate))?></td>
									<td><?=date('d/m/Y', strtotime($product->ExpireDate))?></td>
									<td id="modifiedDate_<?=$product->ProductID?>"><?=date('d/m/Y H:i', strtotime($product->ModifiedDate))?></td>
									<td><a href="<?=base_url('/admin/product/list.html?createdById='.$product->CreatedByID)?>"><?=$product->FullName?></a> </td>
									<td><?=$product->IpAddress?></td>
									<td>
										<a href="<?=base_url('/admin/product/edit.html?postId='.$product->ProductID)?>" data-toggle="tooltip" title="Chỉnh sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;|&nbsp;
										<a onclick="pushPostUp('<?=$product->ProductID?>');" data-toggle="tooltip" title="Làm mới tin"><i class="glyphicon glyphicon-refresh"></i></a>&nbsp;|&nbsp;
										<a class="remove-post" data-post="<?=$product->ProductID?>" data-toggle="tooltip" title="Xóa tin đăng"><i class="glyphicon glyphicon-remove"></i></a>
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
	var sendRequest = function(){
		var searchKey = $('#searchKey').val()||"";
		var fromDate = $('#fromDate').val()||"";
		var toDate = $('#toDate').val()||"";
		var code = $('#code').val()||"";
		var hasAuthor = $('input[name=hasAuthor]:checked').val();
		var status = $('input[name=status]:checked').val();
		var phoneNumber = $('#phoneNumber').val()||"";
		window.location.href = '<?=base_url('admin/product/list.html')?>?query='+searchKey + '&phoneNumber=' + phoneNumber + '&fromDate=' + fromDate + '&toDate=' + toDate + '&hasAuthor=' + hasAuthor + '&code=' + code + '&status=' + status + '&orderField='+curOrderField+'&orderDirection='+curOrderDirection;
	}

	var curOrderField, curOrderDirection;
	$('[data-action="sort"]').on('click', function(e){
		curOrderField = $(this).data('title');
		curOrderDirection = $(this).data('direction');
		sendRequest();
	});


	$('#searchKey').val(decodeURIComponent(getNamedParameter('query')||""));
	$('#fromDate').val(decodeURIComponent(getNamedParameter('fromDate')||""));
	$('#toDate').val(decodeURIComponent(getNamedParameter('toDate')||""));
	$('#code').val(decodeURIComponent(getNamedParameter('code')||""));
	$('#phoneNumber').val(decodeURIComponent(getNamedParameter('phoneNumber')||""));
	if(decodeURIComponent(getNamedParameter('hasAuthor')) != null){
		$("#chb-" + (parseInt(decodeURIComponent(getNamedParameter('hasAuthor'))) + 1)).prop( "checked", true );
	}else{
		$("#chb-0").prop( "checked", true );
	}

	if(decodeURIComponent(getNamedParameter('status')) != null){
		$("#st-" + (parseInt(decodeURIComponent(getNamedParameter('status'))))).prop( "checked", true );
	}else{
		$("#st_0").prop( "checked", true );
	}

	var curOrderField = getNamedParameter('orderField')||"";
	var curOrderDirection = getNamedParameter('orderDirection')||"";
	var currentSort = $('[data-action="sort"][data-title="'+getNamedParameter('orderField')+'"]');
	if(curOrderDirection=="ASC"){
		currentSort.attr('data-direction', "DESC").find('i.glyphicon').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-top active');
	}else{
		currentSort.attr('data-direction', "ASC").find('i.glyphicon').removeClass('glyphicon-triangle-top').addClass('glyphicon-triangle-bottom active');
	}

	function updateView(productId, val){
		$("#pr-" + productId).addClass("process");
		jQuery.ajax({
			type: "POST",
			url: '<?=base_url("/Ajax_controller/updateViewForProductIdManual")?>',
			dataType: 'json',
			data: {productId: productId, view: val},
			success: function(res){
				if(res == 'success'){
					/*bootbox.alert("Cập nhật thành công");*/
					$("#pr-" + productId).addClass("success");
				}
			}
		});
	}
	function updateVip(productId, val){
		jQuery.ajax({
			type: "POST",
			url: '<?=base_url("/Ajax_controller/updateVipPackageForProductId")?>',
			dataType: 'json',
			data: {productId: productId, vip: val},
			success: function(res){
				if(res == 'success'){
					bootbox.alert("Cập nhật thành công");
				}
			}
		});
	}

	function pushPostUp(productId){
		jQuery.ajax({
			type: "POST",
			url: '<?=base_url("/admin/ProductManagement_controller/pushPostUp")?>',
			dataType: 'json',
			data: {productId: productId},
			success: function(res){
				if(res == 'success'){
					bootbox.alert("Cập nhật thành công");
				}
			}
		});
	}

	function deleteMultiplePostHandler(){
		$("#deleteMulti").click(function(){
			var selectedItems = $("input[name='checkList[]']:checked").length;
			if(selectedItems > 0) {
				bootbox.confirm("Bạn đã chắc chắn xóa những tin rao này chưa?", function (result) {
					if (result) {
						$("#crudaction").val("delete-multiple");
						$("#frmPost").submit();
					}
				});
			}else{
				bootbox.alert("Bạn chưa check chọn tin cần xóa!");
			}
		});
	}

	function deletePostHandler(){
		$('.remove-post').click(function(){
			var prId = $(this).data('post');
			bootbox.confirm("Bạn đã chắc chắn xóa tin rao này chưa?", function(result){
				if(result){
					$("#productId").val(prId);
					$("#crudaction").val("delete");
					$("#frmPost").submit();
				}
			});
		});
	}
	$(document).ready(function(){
		deletePostHandler();
		deleteMultiplePostHandler();
	});
</script>
</body>
</html>
