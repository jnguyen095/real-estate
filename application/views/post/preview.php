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
		<meta name="description" content="Tin Bất động sản, Rao tin miễn phí, tin bất động sản miễn phí">
		<meta name="keywords" content="Tin Bất động sản, Rao tin miễn phí, tin bất động sản miễn phí">
		<title>Tin Đất Đai | Đăng Tin Rao Miễn Phí | Tạo Tin Bất Động Sản</title>
		<?php $this->load->view('common_header')?>
		<link rel="stylesheet" href="<?=base_url('/css/stepbar.css')?>">
		<link rel="stylesheet" href="<?=base_url('/css/jquery.mCustomScrollbar.min.css')?>" />
		<link rel="stylesheet" href="<?=base_url('/css/carousel-custom.css')?>" />
		<script src="<?=base_url('/js/jquery.mCustomScrollbar.min.js')?>"></script>
		<script src="<?= base_url('/js/createpost.min_v1.0.js') ?>"></script>
		<?php $this->load->view('/common/googleadsense')?>
</head>
</head>
<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">
	<?php $this->load->view('/theme/header')?>

	<ul class="breadcrumb">
		<li><a href="<?=base_url('/trang-chu.html')?>">Trang chủ</a> </li>
		<li class="active">Đăng tin</li>
		<li class="active">Xem trước</li>
	</ul>

	<div class="row no-margin">
		<div class="col-lg-12 col-sm-12">
			<h1 class="h2title">ĐĂNG TIN</h1>
			<hr/>

			<!-- Step -->
			<div class="row smpl-step" style="border-bottom: 0; min-width: 500px;">
				<div class="col-xs-4 smpl-step-step complete">
					<div class="text-center smpl-step-num">Bước 1</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a class="smpl-step-icon"><i class="glyphicon glyphicon-edit" style="font-size: 35px; padding-left: 19px; padding-top: 16px; color: #fff;"></i></a>
					<div class="smpl-step-info text-center">Soạn bài đăng</div>
				</div>

				<div class="col-xs-4 smpl-step-step complete ">
					<div class="text-center smpl-step-num">Bước 2</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a class="smpl-step-icon"><i class="glyphicon glyphicon-eye-open" style="font-size: 35px; padding-left: 17px; padding-top: 17px; color: #fff;"></i></a>
					<div class="smpl-step-info text-center">Xem trước</div>
				</div>
				<div class="col-xs-4 smpl-step-step ">
					<div class="text-center smpl-step-num">Bước 3</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a class="smpl-step-icon"><i class="glyphicon glyphicon-check" style="font-size: 35px; padding-left: 20px; padding-top: 15px; color: #fff;"></i></a>
					<div class="smpl-step-info text-center">Đăng bài</div>
				</div>
			</div>
			<!-- end -->

			<!-- content -->
			<div class="col-md-9 no-margin no-padding product-detail">
				<div class="product-title"><?php echo $product->Title?></div>
				<div class="row">
					<div class="col-md-4">Giá: <span class="color bold"><?php echo $product->PriceString?></span><span class="margin-left-10">Diện tích: <span class="color bold"><?php echo $product->Area?></span></span></div>
					<div class="col-md-8 text-right">
						<span class="color bold glyphicon glyphicon-map-marker"></span><span class="color bold">
				<?php
				if(isset($product->Street)){
					echo $product->Street;
				}
				if(isset($product->Ward)){
					echo ' - ';
					echo $product->Ward->WardName;
				}
				if(isset($product->District)){
					echo ' - ';
					echo $product->District->DistrictName;
				}
				if(isset($product->City)){
					echo ' - ';
					echo $product->City->CityName;
				}
				?>
				</span>
					</div>
				</div>

				<?php
				if($product->Assets != null && count($product->Assets) > 0) {
					?>
					<div class="product-assets">
						<div id='carousel-custom' class='carousel slide' data-interval="false" data-ride='carousel'>
							<div class='carousel-outer'>
								<!-- Wrapper for slides -->
								<div class='carousel-inner'>
									<?php
									$isFirst = true;
									foreach ($product->Assets as $asset) {
										if ($isFirst) {
											echo '<div class="item active">';
											$isFirst = false;
										} else {
											echo '<div class="item">';
										}
										echo '<img src="' . str_replace('resize/200x200/', '', $asset->OrgUrl) . '" alt=\'\' />';
										echo '</div>';
									}
									?>
								</div>

								<!-- Controls -->
								<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
									<span class='glyphicon glyphicon-chevron-left'></span>
								</a>
								<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
									<span class='glyphicon glyphicon-chevron-right'></span>
								</a>
							</div>

							<!-- Indicators -->
							<ol class='carousel-indicators mCustomScrollbar'>
								<?php
								$i = 0;
								foreach ($product->Assets as $asset) {
									if ($i == 0) {
										echo '<li data-target="#carousel-custom" data-slide-to="' . $i . '" class="active"><img src="' . $asset->Url . '" /></li>';
									} else {
										echo '<li data-target="#carousel-custom" data-slide-to="' . $i . '"><img src="' . $asset->Url . '" /></li>';
									}

									$i++;
								}
								?>
							</ol>
						</div>
					</div>
					<?php
				}
				?>

				<h2 class="h2title">Chi Tiết
					<hr/>
				</h2>

				<div class="product-detail content"><?php echo $product->Detail?></div>

				<div class="row">
					<div class="col-md-8">
						<table class="table tableBorder">
							<tr class="tbHeader">
								<td colspan="2">Đặc Điểm</td>
							</tr>
							<tr>
								<td>Chiều rộng</td>
								<td><?=$product->WidthSize != null ? $product->WidthSize.'m' : '-'?></td>
							</tr>
							<tr>
								<td>Chiều dài</td>
								<td><?=$product->LongSize != null ? $product->LongSize. 'm' : '-'?></td>
							</tr>
							<tr>
								<td>Số tầng</td>
								<td><?=$product->Floor != null ? $product->Floor : '-'?></td>
							</tr>
							<tr>
								<td>Số phòng</td>
								<td><?=$product->Room != null ? $product->Room : '-'?></td>
							</tr>
							<tr>
								<td>Nhà vệ sinh</td>
								<td><?=$product->Toilet != null ? $product->Toilet : '-'?></td>
							</tr>
							<tr>
								<td>Hướng</td>
								<td><?=(isset($product->Direction) && $product->Direction) ? $product->Direction->DirectionName : 'KXĐ'?></td>
							</tr>
							<?php
							if(isset($product->Brand) && $product->Brand != null){
								echo '<td>Thuộc dự án</td>';
								echo '<td>'.$product->Brand->BrandName.'</td>';
							}
							?>
						</table>
					</div>
					<div class="col-md-4">
						<table class="table tableBorder">
							<tr class="tbHeader">
								<td colspan="2">Liên Hệ</td>
							</tr>
							<tr>
								<td class="width100">Liên hệ</td>
								<td><?=$product->ContactName != null ? $product->ContactName : '-'?></td>
							</tr>
							<tr>
								<td class="width100">Số ĐT</td>
								<td><?=$product->ContactPhone != null ? $product->ContactPhone : '-'?></td>
							</tr>
							<tr>
								<td class="width100">Địa chỉ</td>
								<td><?=$product->ContactAddress != null ? $product->ContactAddress : '-'?></td>
							</tr>
							<tr>
								<td class="width100">Email</td>
								<td><?=$product->ContactEmail != null ? $product->ContactEmail : '-'?></td>
							</tr>
						</table>
					</div>
				</div>


				<h2 class="h2title">Bản Đồ<span class="required">(Thay đổi vị trí bằng cách click lên bản đồ)</span>
					<hr/>
				</h2>
				<?php $this->load->view('/EditMap_view')?>

			</div>
			<div class="col-md-3 no-margin-right no-padding-right">
				<div class="subscribe-panel col-md-12 no-padding">
					<div class="well">
						<div class="row text-center panel-title">HƯỚNG DẪN ĐĂNG TIN</div>
						<div class="guidline">
							<ul>
								<li><span class="pullet">Bài đăng vẫn đang khóa, bài sẻ hiễn thị ra bên ngoài sau khi click button "Đăng Bài"</span></li>
								<li><span class="pullet">Muốn chỉnh sửa nội dung click "Quay Lại Chỉnh Sửa"</span></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="subscribe-panel col-md-12 no-padding">
					<div class="well">
						<div class="row text-center panel-title">BẢN ĐỒ</div>
						<div class="guidline">
							<ul>
								<li><span class="pullet">Chọn vị trí trên bản đồ nơi bất động sản đang có rồi click vào đó để thay đổi vị trí</span></li>
								<li><span class="pullet">Cập nhật bản đồ sẻ tăng thêm tính xác thực và tiếp cận đúng người mua/bán</span></li>

							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- end content -->


			<div class="clear-both"></div>
			<div class="row col-md-12 text-center margin-top-20">
				<input type="hidden" name="crudaction" value="add_new">
				<a href="<?=base_url('/chinh-sua-p'.$product->ProductID.'.html')?>" class="btn btn-danger">Quay Lại Chỉnh Sửa</a>
				<?php if($this->session->userdata('loginid') > 0) { ?>
					<a href="<?= base_url('/quan-ly-tin-rao.html') ?>" class="btn btn-info">Chỉ Lưu Tạm</a>
					<?php
				}
				?>
				<a href="<?=base_url('/dang-bai-thanh-cong-p'.$product->ProductID.'.html')?>" class="btn btn-info">Đăng Bài</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".mCustomScrollbar").mCustomScrollbar({axis:"x"});

		});
	</script>

	<!-- Place this tag in your head or just before your close body tag. -->
	<script src="https://apis.google.com/js/platform.js" async defer></script>

	<?php $this->load->view('/theme/footer')?>
</div>

</body>
</html>
