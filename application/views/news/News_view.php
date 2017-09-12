<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<meta name="description" content="Tin tức bất động sản, nhà đất, chung cư">
	<meta name="keywords" content="Bất động sản, bán nhà, chung cư, mua đất, bán đất, real estate">
	<title>Tin Đất Đai | Tin Tức Về Bất Động Sản</title>
	<?php $this->load->view('common_header')?>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body class="news">
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">

<?php $this->load->view('/theme/header')?>

<ul class="breadcrumb">
	<li><a href="<?=base_url().'trang-chu.html'?>">Trang Chủ</a></li>
	<li class="active">Tin Tức</li>
</ul>
<div class="row no-margin">
	<div class="col-md-9  no-margin no-padding">
		<div class="search-result-panel col-md-12">Tin Tức Về Bất Động Sản</div>
		<div class="product-panel col-md-12  no-margin no-padding">
			<?php
				if(isset($news) && count($news) > 0){
					foreach ($news as $new) {
						echo '<div class="row product-list">';
						echo '<div class="row product-title"><a href="' . base_url() . seo_url($new->Title) . '-n' . $new->NewsID . '.html">' . $new->Title . '</a> </div>';

						echo '<div class="row product-content">';
						echo '<div class="col-md-2 col-xs-5 no-padding"><a href="' . base_url() . seo_url($new->Title) . '-n' . $new->NewsID . '.html"><img style="max-width: 120px" src="' . $new->Thumb . '" alt="'.$new->Title.'"/></a></div>';
						echo '<div class="col-md-10 col-xs-7">';
						echo '<div class="row pos-relative">';

						echo '<div class="productTop">';
						echo '<div class="col-md-12 col-xs-12 color bold relative-time no-padding text-left">' . date('d/m/Y', strtotime($new->CreatedDate)) . '</div>';
						echo '<div class="clear-both"></div>';
						echo '</div>';

						echo '<div class="col-md-12 col-xs-12 product-brief no-padding">';
						echo '<div class="no-margin no-padding col-md-12 col-xs-12">' . $new->Brief . '</div>';
						echo '</div>';

						echo '</div>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
					}
				}
			?>
			<?php
			if(isset($news) && count($news) > 0) {
				?>
				<div class="row text-center">
					<?php if (isset($pagination)) echo $pagination ?>
				</div>
				<?php
			}else{
				?>
				<div class="alert alert-warning">Không tìm thấy dữ liệu phù hợp, vui lòng chọn danh mục khác.</div>
				<?php
			}
			?>
		</div>
	</div>
	<div class="col-md-3 no-margin-right no-padding-right">
		<?php $this->load->view('/common/Search_filter') ?>
	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
