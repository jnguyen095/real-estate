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
				Quản lý bài đăng
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li class="active">Quản lý bài đăng</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">
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
							<div class="col-sm-3">
								<label>Từ ngày</label>
								<div class="form-group">
									<input type="text" class="form-control datepicker" id="fromDate">
								</div>
							</div>
							<div class="col-sm-3">
								<label>Đến ngày</label>
								<div class="form-group">
									<input type="text" class="form-control datepicker" id="toDate">
								</div>
							</div>
						</div>
						<div class="text-center">
							<a class="btn btn-primary" onclick="sendRequest()">Tìm kiếm</a>
						</div>
					</div>

					<table class="admin-table table table-bordered table-striped">
						<thead>
							<tr>
								<th></th>
								<th data-action="sort" data-title="Title" data-direction="ASC"><span>Tiêu đề</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="Status" data-direction="ASC"><span>Status</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="Vip" data-direction="ASC"><span>Loại tin</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="View" data-direction="ASC"><span>Lượt xem</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="PostDate" data-direction="ASC"><span>Ngày đăng</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th data-action="sort" data-title="CreatedByID" data-direction="ASC"><span>Người đăng</span><i class="glyphicon glyphicon-triangle-bottom"></i></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$counter = 1;
						foreach ($products as $product) {
							?>
							<tr>
								<td><?=$counter++?></td>
								<td><?=$product->Title?></td>
								<td><?=$product->Status == 1 ? 'Show' : 'Hide'?></td>
								<td><?=$product->Vip?></td>
								<td><input class="txtView" type="text" value="<?=$product->View?>" onchange="updateView('<?=$product->ProductID?>', this.value);"/></td>
								<td><?=date('d/m/Y H:i', strtotime($product->PostDate))?></td>
								<td><?=$product->CreatedByID?></td>
								<td>
									<a data-toggle="tooltip" title="Xem tin đăng"><i class="glyphicon glyphicon-folder-open"></i></a>&nbsp;|&nbsp;
									<a data-toggle="tooltip" title="Xóa tin đăng"><i class="glyphicon glyphicon-remove"></i></a>
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
<script src="<?=base_url('/js/bootbox.min.js')?>"></script>
<script src="<?=base_url('/admin/js/bootstrap-datepicker.min.js')?>"></script>
<script src="<?=base_url('/admin/js/tindatdai_admin.js')?>"></script>

<script type="text/javascript">
	var sendRequest = function(){
		var searchKey = $('#searchKey').val()||"";
		var fromDate = $('#fromDate').val()|"";
		var toDate = $('#toDate').val()|"";
		window.location.href = '<?=base_url('admin/product/list.html')?>?query='+searchKey+ '&fromDate=' + fromDate + '&toDate=' + toDate + '&orderField='+curOrderField+'&orderDirection='+curOrderDirection;
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

	var curOrderField = getNamedParameter('orderField')||"";
	var curOrderDirection = getNamedParameter('orderDirection')||"";
	var currentSort = $('[data-action="sort"][data-title="'+getNamedParameter('orderField')+'"]');
	if(curOrderDirection=="ASC"){
		currentSort.attr('data-direction', "DESC").find('i.glyphicon').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-top active');
	}else{
		currentSort.attr('data-direction', "ASC").find('i.glyphicon').removeClass('glyphicon-triangle-top').addClass('glyphicon-triangle-bottom active');
	}

	function updateView(productId, val){
		jQuery.ajax({
			type: "POST",
			url: '<?=base_url("/Ajax_controller/updateViewForProductIdManual")?>',
			dataType: 'json',
			data: {productId: productId, view: val},
			success: function(res){
				if(res == 'success'){
					bootbox.alert("Cập nhật thành công");
				}
			}
		});
	}
</script>
</body>
</html>
