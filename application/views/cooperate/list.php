<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<meta name="description" content="Hợp tác, tìm đối tác, góp vốn, bất động sản, nhà đất, chung cư">
	<meta name="keywords" content="Bất động sản, bán nhà, chung cư, mua đất, bán đất, real estate">
	<title>Hợp Tác Bất Động Sản</title>
	<?php $this->load->view('common_header')?>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body class="news">
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">

<?php $this->load->view('/theme/header')?>

<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?=base_url().'trang-chu.html'?>"><span itemprop="name">Trang Chủ</span></a><meta itemprop="position" content="1" /></li>
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name">Hợp Tác</span></span><meta itemprop="position" content="2" /></li>
	<?php $this->load->view('/common/quick-search')?>
</ul>
<div class="row no-margin">
	<div class="col-md-9  no-margin no-padding">
		<div class="cooperate-result-panel col-md-12">
			<div class="float-left title">Hợp Tác Bất Động Sản</div>
			<div class="float-right"><a class="btn btn-tindatdai btn-sm" href="<?=base_url('dang-tin-hop-tac')?>">Đăng Tin Hợp Tác</a></div>
			<div class="clear-both"></div>
		</div>
		<div class="cooperate-panel col-md-12  no-margin no-padding">
			<?php
				if(isset($cooperates) && count($cooperates) > 0){
					foreach ($cooperates as $cooperate) {
						?>
						<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 coo-item">
							<div class="coo-title"><a href="<?=base_url(seo_url($cooperate->Title).'-co'.$cooperate->CooperateID.'.html')?>"><?=$cooperate->Title?></a></div>
							<div class="coo-price-date">
								<span class="float-left price"><?=$cooperate->PriceString?></span>
								<span class="float-right text-right"><?=date('d/m/Y', strtotime($cooperate->ModifiedDate))?></span>
								<div class="clear-both"></div>
							</div>
							<div class="coo-image">
								<img class="width100pc" src="<?=base_url($cooperate->Thumb)?>" alt="<?=$cooperate->Title?>"/>
							</div>
							<div class="cool-location">
								<?=$cooperate->Address?>
							</div>
						</div>
					<?php
					}
				}
			?>
			<div class="clear-both"></div>
			<?php
			if(isset($cooperates) && count($cooperates) > 0) {
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
	<div class="col-md-3 no-margin-right no-padding-right no-padding-left-mobile">
		<?php $this->load->view('/common/sample_house') ?>
		<?php $this->load->view('/common/Search_filter') ?>
	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
