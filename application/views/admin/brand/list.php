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
				<li class="active">Quản lý dự án</li>
			</ol>
		</section>

		<!-- Main content -->
		<?php
		$attributes = array("id" => "frmPost");
		echo form_open("admin/brand/list", $attributes);
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
					<div class="search-filter">
						<div class="row">
							<div class="col-sm-6">
								<label>Tiêu đề</label>
								<div class="form-group">
									<input type="text" name="searchFor" placeholder="Tìm tiêu đề" class="form-control" id="searchKey">
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

					<table class="admin-table table table-bordered table-striped">
						<thead>
							<tr>
								<th><input name="checkAll" value="1" type="checkbox" ></th>
								<th data-action="sort" data-title="BrandName" data-direction="ASC"><span>Tên dự án</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th>Số tin rao</th>
								<th data-action="sort" data-title="Hot" data-direction="ASC"><span>Hot</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="Owner" data-direction="ASC"><span>Chủ đầu tư</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="Thumb" data-direction="ASC"><span>Ảnh</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="ModifiedDate" data-direction="ASC"><span>Ngày cập nhật</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th></th>
							</tr>
						</thead>
						<tbody>

						<?php
						$counter = 1;
						foreach ($brands as $brand) {
							?>
							<tr>
								<td><input name="checkList[]" type="checkbox" value="<?=$brand->BrandID?>"></td>
								<td><a data-toggle="tooltip" title="<?=$brand->BrandName?>" href="<?=base_url(seo_url($brand->BrandName).'-b').$brand->BrandID.'.html'?>"><?=substr_at_middle($brand->BrandName, 80)?></a></td>
								<td><?=$brand->TotalProduct?></td>
								<td>
									<select id="selectid-<?=$brand->BrandID?>" onchange="updateHot('<?=$brand->BrandID?>')">
										<option value="0" <?=($brand->Hot == null || !isset($brand->Hot) || $brand->Hot == 0) ? 'selected' : ''?> >Standard</option>
										<option value="1" <?=$brand->Hot == 1? 'selected' : ''?> >Hot</option>
									</select>
								</td>
								<td><?=$brand->Owner?></td>
								<td><?=$brand->Thumb?></td>
								<td><?=date('d/m/Y H:i', strtotime($brand->ModifiedDate))?></td>
								<td>
									<a href="<?=base_url('/admin/brand/view-'.$brand->BrandID.'.html')?>" data-toggle="tooltip" title="Xem chi tiết"><i class="glyphicon glyphicon-folder-open"></i></a>
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
		<input type="hidden" id="crudaction" name="crudaction">
		<input type="hidden" id="CooperateID" name="productId">
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
		window.location.href = '<?=base_url('admin/brand/list.html')?>?query='+searchKey+ '&orderField='+curOrderField+'&orderDirection='+curOrderDirection;
	}

	var curOrderField, curOrderDirection;
	$('[data-action="sort"]').on('click', function(e){
		curOrderField = $(this).data('title');
		curOrderDirection = $(this).data('direction');
		sendRequest();
	});


	$('#searchKey').val(decodeURIComponent(getNamedParameter('query')||""));

	var curOrderField = getNamedParameter('orderField')||"";
	var curOrderDirection = getNamedParameter('orderDirection')||"";
	var currentSort = $('[data-action="sort"][data-title="'+getNamedParameter('orderField')+'"]');
	if(curOrderDirection=="ASC"){
		currentSort.attr('data-direction', "DESC").find('i.glyphicon').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-top active');
	}else{
		currentSort.attr('data-direction', "ASC").find('i.glyphicon').removeClass('glyphicon-triangle-top').addClass('glyphicon-triangle-bottom active');
	}

	function updateHot(brandId){

		var hot = $("#selectid-" + brandId + " option:selected").val();
		jQuery.ajax({
			type: "POST",
			url: '<?=base_url("/admin/BrandManagement_controller/updateHot")?>',
			dataType: 'json',
			data: {BrandID: brandId, Hot: hot},
			success: function(res){
				if(res == 'success'){
					bootbox.alert("Cập nhật thành công");
				}
			}
		});
	}


	function pushPostUp(CooperateID){
		jQuery.ajax({
			type: "POST",
			url: '<?=base_url("/admin/CooperateManagement_controller/pushPostUp")?>',
			dataType: 'json',
			data: {CooperateID: CooperateID},
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
					$("#CooperateID").val(prId);
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
