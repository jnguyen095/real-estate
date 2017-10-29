<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/9/2017
 * Time: 2:19 PM
 */
?>
<!DOCTYPE html>
<html>
<head>
	<head>
		<meta charset = "utf-8">
		<title>Tin Đất Đai | Quản Lý Tin Rao</title>
		<?php $this->load->view('common_header')?>
		<script src="<?= base_url('/js/createpost.min_v1.0.js') ?>"></script>
		<script src="<?=base_url('/js/bootbox.min.js')?>"></script>
		<?php $this->load->view('/common/googleadsense')?>
</head>
</head>
<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">
	<?php $this->load->view('/theme/header')?>

	<ul class="breadcrumb">
		<li><a href="<?=base_url('/trang-chu.html')?>">Trang chủ</a> </li>
		<li class="active">Quản lý tin rao</li>
	</ul>

	<div class="row no-margin">
		<div class="col-lg-12 col-sm-12">
			<div>
				<div class="float-left h2title">Quản lý tin rao</div>
				<div class="float-right">
					<?php
					if(count($products) > 0) {
						?>
						<a href="<?=base_url('/dang-tin.html')?>" class="btn btn-info">Đăng Tin Rao Bất Động Sản</a> </td>
						<?php
					}
					?>
				</div>
				<div class="clear-both"></div>
			</div>
			<hr/>

			<?php if(!empty($message_response)){
				echo '<div class="alert alert-success">';
				echo '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>';
				echo $message_response;
				echo '</div>';
			}?>

			<?php
			$attributes = array("id" => "frmPost");
			echo form_open("quan-ly-tin-rao", $attributes);
			?>
			<!-- content -->
			<div class="col-md-12 no-margin no-padding text-center">
				<table class="table table-bordered table-hover table-striped">
					<thead class="thead-table">
						<tr class="bg-success">
							<th>#</th>
							<th>Tiêu đề</th>
							<th>Lượt xem</th>
							<th>Ngày đăng</th>
							<th class="mobile-hide">Ngày cập nhật <i class="glyphicon glyphicon-triangle-bottom"></i></th>
							<th class="mobile-hide">Tình trạng</th>
							<th>Chỉnh sửa</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if(count($products) < 1) {
						?>
					<tr>
						<td colspan="7">Chưa có tin rao nhà đất nào, vào đây <a href="<?=base_url('/dang-tin.html')?>" class="btn btn-info">Đăng Tin Rao Bất Động Sản</a> để tạo tin rao. </td>
					</tr>
						<?php
					}
					?>
					<?php
						$counter = 1;
						foreach ($products as $product) {
							?>
							<tr>
								<th scope="row"><?=$counter++?></th>
								<td class="text-left"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID.'.html'?>" target="_blank" title="<?=$product->Title?>"><?=substr_with_ellipsis($product->Title, 60)?></a></td>
								<td><?=$product->View?></td>
								<td>
									<?php
										$datestring = '%d/%m/%Y';
										echo mdate($datestring, strtotime($product->PostDate));
									?>
								</td>
								<td class="mobile-hide">
									<?php
									$datestring = '%d/%m/%Y H:i';
									echo date('d/m/Y H:i', strtotime($product->ModifiedDate));
									?>
								</td>
								<td class="mobile-hide"><?php
									if($product->Status == 1){
										echo '<span class="active">Hoạt động</span>';
									}else{
										echo '<span class="inactive">Tạm ngưng</span>';
									}
									?></td>
								<td class="table-icons">
									<a href="<?=base_url('chinh-sua-p'.$product->ProductID.'.html')?>" data-toggle="tooltip" title="Chỉnh sửa tin rao"><span class="glyphicon glyphicon-edit"></span></a> |
									<?php if($product->Status == 1){?>
									<a class="refresh-post" data-post="<?=$product->ProductID?>" data-toggle="tooltip" title="Làm mới tin rao"><span class="glyphicon glyphicon-circle-arrow-up"></span></a> |
									<a class="inactive-post" data-post="<?=$product->ProductID?>" data-toggle="tooltip" title="Tạm ngưng, không hiển thị ra ngoài"><span class="glyphicon glyphicon-ban-circle"></span></a> |
									<?php }else {?>
									<a class="active-post" data-post="<?=$product->ProductID?>" data-toggle="tooltip" title="Mở hoạt động"><span class="glyphicon glyphicon-ok-circle"></span></a> |
									<?php }?>
									<a class="remove-post" data-post="<?=$product->ProductID?>" data-toggle="tooltip" title="Xóa tin rao"><span class="glyphicon glyphicon-remove"></span></a>
								</td>
							</tr>
							<?php
						}
					?>
					</tbody>
				</table>
				<div class="row text-center">
					<?php if (isset($pagination)) echo $pagination; ?>
				</div>

			</div>
			<!-- end content -->
			<input type="hidden" id="crudaction" name="crudaction">
			<input type="hidden" id="productId" name="productId">
			<?php echo form_close(); ?>

			<div class="clear-both"></div>
		</div>
	</div>

	<?php $this->load->view('/theme/footer')?>
</div>

</body>
</html>
