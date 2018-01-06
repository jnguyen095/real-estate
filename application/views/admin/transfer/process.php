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
	<title>Tin Đất Đai | Xử lý giao dịch</title>
	<?php $this->load->view('/admin/common/header-js') ?>
	<link rel="stylesheet" href="<?=base_url('/css/iCheck/all.css')?>">
	<link rel="stylesheet" href="<?=base_url('/admin/css/madmin.css')?>">
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
				Xử lý giao dịch cho user: <b><?=$user->FullName?></b>, Số ĐT: <b><?=$user->Phone?></b>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?=base_url('/admin/dashboard.html')?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
				<li class="active">Xử lý giao dịch cho</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content container-fluid">
			<?php if(!empty($error_message)){
				echo '<div class="alert alert-danger">';
				echo $error_message;
				echo '</div>';
			}?>
			<?php if(!empty($message_response)){
				echo '<div class="alert alert-success">';
				echo $message_response;
				echo '</div>';
			}?>
			<div class="box">
				<!-- /.box-header -->
				<div class="box-body">
					<?php
					$attributes = array("id" => "frmAddStaticPage", "class" => "form-horizontal col-lg-6");
					echo form_open("admin/transfer-user-".$user->Us3rID, $attributes);
					?>
					<div class="form-group">
						<div class="col-md-4">
							<label>Loại giao dịch <span class="required">*</span> </label>
						</div>
						<div class="col-md-8">
							<select class="form-control" name="sl_type">
								<option>Chọn loại giao dịch</option>
								<option value="1" <?php echo $sl_type == 1 ? 'selected' : ''; ?>>Thêm tiền vào tài khoản</option>
								<option value="-1" <?php echo $sl_type == -1 ? 'selected' : ''; ?>>Rút tiền ra tài khoản</option>
							</select>
							<span class="text-danger"><?php echo form_error('sl_type'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-4">
							<label>Số tiền <span class="required">*</span></label>
						</div>
						<div class="col-md-8">
							<input type="text" name="txt_money" class="form-control" value="<?php echo set_value('txt_money', $txt_money); ?>">
							<span class="text-danger"><?php echo form_error('txt_money'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-4">
							<label>Lý do <span class="required">*</span></label>
						</div>
						<div class="col-md-8">
							<input type="text" name="txt_reason" class="form-control" value="<?php echo set_value('txt_reason', $txt_reason); ?>">
							<span class="text-danger"><?php echo form_error('txt_reason'); ?></span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-8 col-md-offset-4">
							<a href="<?=base_url('/admin/user/list.html')?>" class="btn btn-default btn-flat">Trở lại</a>
							<button type="submit" class="btn btn-primary btn-flat">Lưu</button>
						</div>

					</div>
					<input type="hidden" name="userId" value="<?=$user->Us3rID?>">
					<input type="hidden" name="crudaction" value="insert">
					<?php echo form_close(); ?>

					<table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>STT</th>
							<th>Ngày giao dịch</th>
							<th>Ghi nợ</th>
							<th>Ghi có</th>
							<th>Lý do</th>
							<th>Status</th>
							<th>Thực hiện</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($histories) && count($histories) > 0) {
							$counter = 1;
							$sumDeposited = 0;
							$sumSpent = 0;
							foreach ($histories as $history) {
								?>
								<tr>
									<td><?=$counter++?></td>
									<td><?=date('d/m/Y H:i', strtotime($history->TransferTime))?></td>
									<td class="text-right"><?php
										if($history->Type == -1 && $history->Status == ACTIVE){
											$sumSpent += $history->Money;
											echo number_format($history->Money);
										}
										?>
									</td>
									<td class="text-right"><?php
										if($history->Type == 1 && $history->Status == ACTIVE){
											$sumDeposited += $history->Money;
											echo number_format($history->Money);
										}
										?>
									</td>
									<td><?=$history->Reason?></td>
									<td><?=$history->Status == ACTIVE ? '<span class="success">Thành Công</span>' : '<span class="paymentDelay">Treo</span>'?></td>
									<td><?=$history->FullName?></td>
									<td><a class="deleteTransfer" data-toggle="tooltip" title="Xóa giao dịch này" data-userid="<?=$user->Us3rID?>" data-historyid="<?=$history->PurchaseHistoryID?>"><i class="glyphicon glyphicon-trash"></i></a></td>
								</tr>
								<?php
							}
							?>
							<tr>
								<td colspan="2"></td>
								<td class="text-right"><strong><?=number_format($sumSpent)?></strong></td>
								<td class="text-right"><strong><?=number_format($sumDeposited)?></strong></td>
								<td colspan="3"></td>
							</tr>
							<tr>
								<td colspan="3" class="text-right">Số dư khả dụng:</td>
								<td class="text-right"><strong class="label label-success"><?=number_format($sumDeposited - $sumSpent)?></strong></td>
								<td colspan="4"></td>
							</tr>
						<?php
						}else{
							echo '<tr><td colspan="9" class="text-center">Chưa có giao dịch nào</td></tr>';
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

<script src="<?=base_url('/ckeditor/ckeditor.js')?>"></script>

<script src="<?=base_url('/css/iCheck/icheck.min.js')?>"></script>

<script src="<?=base_url('/admin/js/tindatdai_admin.js')?>"></script>

<script src="<?=base_url('/js/bootbox.min.js')?>"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script type="text/javascript">
	$(document).ready(function(){
		$(".deleteTransfer").click(function(){
			$this = $(this);
			bootbox.confirm("Bạn đã chắc chắn xóa giao dịch này chưa?", function (result) {
				if (result) {
					var userId = $this.data('userid');
					var historyId = $this.data('historyid');
					location.href = '<?=base_url()?>' + '/admin/transfer-user-' + userId + '.html?deleteId=' + historyId;
				}
			});
		});
	});
</script>
</body>
</html>
