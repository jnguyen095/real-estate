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
		<link rel="stylesheet" href="<?=base_url('/css/stepbar.css')?>">
		<script src="<?= base_url('/ckeditor/ckeditor.js') ?>"></script>
		<?php $this->load->view('common_header')?>
		<script src="<?= base_url('/js/createpost.min_v1.1.js') ?>"></script>
</head>
</head>
<body class="create-post">
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">
	<?php $this->load->view('/theme/header')?>

	<ul class="breadcrumb">
		<li><a href="<?=base_url('/trang-chu.html')?>">Trang chủ</a> </li>
		<li class="active">Đăng tin  <?=ROUND(1+RAND()* 4)?></li>
	</ul>

	<div class="row no-margin">
		<div class="col-lg-12 col-sm-12 no-padding">
			<h1 class="h2title">ĐĂNG TIN RAO BẤT ĐỘNG SẢN</h1>
			<hr/>

			<div class="col-lg-9 col-sm-9">
				<div class="alert alert-danger">
					<b>Mỗi ngày bạn chỉ được đăng <?=MAX_POST_PER_DAY?> tin rao miễn phí!</b> Hãy đăng tin VIP để không giới hạn lần đăng trong ngày và tiếp cận khách hàng tốt hơn.
				</div>
			</div> <!-- end column 9 -->

			<div class="col-lg-3 col-sm-3">
				<div class="subscribe-panel col-md-12 no-padding">
					<div class="well">
						<div class="row text-center panel-title">HƯỚNG DẪN ĐĂNG TIN</div>
						<div class="guidline">
							<ul>
								<li><span class="pullet">Thông tin có (<span class="required">*</span>) là bắt buộc nhập</span></li>
								<li><span class="pullet">Chọn loại tin rao phù hợp sẻ tiếp cận đúng người mua/bán</span></li>
								<li><span class="pullet">Hình đại diện để hiễn thị trang danh sách và tìm kiếm</span></li>
								<li><span class="pullet">Chọn "Upload thêm hình" để có nhiều thông tin, được hiễn thị trong trang chi tiết</span></li>
								<li><span class="pullet">Chỉnh sửa thông tin liên hệ chỉ ảnh hưởng đến tin đăng hiện tại</span></li>
								<li><span class="pullet">Viết tiếng việt có dấu để tăng hiệu quả và tìm kiếm</span></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="subscribe-panel col-md-12 no-padding">
					<div class="well">
						<div class="row text-center panel-title">HÌNH ẢNH</div>
						<div class="guidline">
							<ul>
								<li><span class="pullet">"Hình đại diện" xuất hiện trang tìm kiếm và danh sách</span></li>
								<li><span class="pullet">"Upload thêm hình" hiễn thị trang chi tiết, nên có khoảng từ 2 - 5 ảnh sẻ trực quan hơn</span></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="subscribe-panel col-md-12 no-padding">
					<div class="well">
						<div class="row text-center panel-title">LIÊN HỆ</div>
						<div class="guidline">
							<ul>
								<li><span class="pullet">Thông tin liên hệ sẻ xuất hiện trang chi tiết, để người cần thông tin liên hệ mua bán</span></li>
							</ul>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>
	<?php $this->load->view('/theme/footer')?>
</div>
</body>
</html>
