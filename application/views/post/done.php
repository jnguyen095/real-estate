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
		<li class="active">Thành công</li>
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
					<div class="smpl-step-info text-center">Bản đồ</div>
				</div>
				<div class="col-xs-4 smpl-step-step complete">
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
			<div class="col-md-12 no-margin no-padding text-center">
				<?php
				if($result == 1) {
					?>
					<div class="post-success">
						<div class="title">Đăng tin thành công!</div>
						<div>Link đến tin rao: <a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID.'.html'?>"><?=base_url().seo_url($product->Title).'-p'.$product->ProductID.'.html'?></a></div>
						<div class="margin-top-20"><a href="<?=base_url('/dang-tin.html')?>">&raquo;Đăng tin mới</a>
							<?php if($this->session->userdata('loginid') > 0) { ?>
								&nbsp;&nbsp;<a href="<?= base_url('/quan-ly-tin-rao.html') ?>">&raquo;Đến trang quản lý
									tin rao</a>
								<?php
							}
							?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
			<!-- end content -->

			<div class="clear-both"></div>
		</div>
	</div>

	<?php $this->load->view('/theme/footer')?>
</div>

</body>
</html>
