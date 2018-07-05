<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/19/2017
 * Time: 11:17 AM
 */

?>
<a id="myBtn" href="javascript:void(0);" class="mobile-hide" title="Go to top"><img src="<?=base_url('/img/gotop.png')?>" alt="Go Top"/></a>
<div class="footer row no-margin">
	<div class="quickLink mobile-hide">
		<?php
		//print_r($footerMenus);
		foreach ($footerMenus as $key => $footerMenu){
			echo '<div class="city-footer-block"><div class="fTitle">'.$footerMenu['CityName'].'</div><ul>';
			$counter = 1;
			foreach ($footerMenu['child'] as $ch){
				if($counter < 11) {
					echo '<li><a href="' . base_url() . seo_url($ch->CatName) . '-' . seo_url($ch->CityName) . '-cc' . $ch->CategoryID . '-' . $ch->CityID . '.html">' . $ch->CatName . ' ' . $ch->CityName . '</a></li>';
				}else if($counter == 11){
					echo '<div id="ct_'.$ch->CityID.'" class="collapse">';
				}else{
					echo '<li><a href="' . base_url() . seo_url($ch->CatName) . '-' . seo_url($ch->CityName) . '-cc' . $ch->CategoryID . '-' . $ch->CityID . '.html">' . $ch->CatName . ' ' . $ch->CityName . '</a></li>';
				}
				$counter++;
			}
			echo '</div><a href="javascript:void(0);" class="toggleBtn toggleMore" data-status="open" data-toggle="collapse" data-target="#ct_'.$ch->CityID.'">Xem thêm</a>';
			echo '</ul></div>';
		}
		?>
		<div class="clear-both"></div>
	</div>
	<div class="menu_bottom">
		<ul>
			<li><a href="<?=base_url('/bao-gia-quang-cao.html')?>">Báo giá quảng cáo</a></li>
			<li><a href="<?=base_url('/dieu-khoan-su-dung.html')?>">Điều khoản thỏa thuận</a></li>
			<li><a href="<?=base_url('/quy-che-hoat-dong.html')?>">Quy chế hoạt động</a></li>
			<li><a href="<?=base_url('/bao-gia-dich-vu.html')?>">Báo giá</a></li>
			<li><a href="#">Câu hỏi thường gặp</a></li>
			<li><a href="javascript:void(0);" id="contactModalForm">Liên hệ - góp ý</a></li>
			<li><a href="<?=base_url('/tuyen-dung.html')?>">Tuyển dụng</a></li>

		</ul>
	</div>
	<div class="copyright text-center">
		<div>Copyright © 2018 tindatdai.com ® Ghi rõ nguồn "tindatdai.com" khi phát hành lại thông tin từ website này.</div>
		<div>Hotline: <b>Phạm Đa Hiệu 0903.136.892</b> | Email:  dahieubds@gmail.com</div>
		<div>Hỗ trợ kỹ thuật: 0982.647.619 | Email: tindatdai@gmail.com | <a rel="nofollow" href="skype:nhukhang095?chat" title="Chát với http://tindatdai.com"><img src="<?=base_url('/img/skype.png')?>" alt="Skype icon"/></a> </div>
	</div>

	<!-- Modal -->
	<form id="modalForm" role="form">
		<div class="modal fade" id="modalFormDialog" role="dialog">

		</div>
	</form>
</div>
<script>
	var urls = {
		social_login_url: '<?=base_url('/login_controller/socialLogin')?>',
		uploadOthersImages: '<?= base_url('/post_controller/do_upload_others_images') ?>',
		loadOthersImages: '<?= base_url('/post_controller/loadOthersImages') ?>',
		removeSecondaryImage: '<?= base_url('/post_controller/removeSecondaryImage') ?>',
		loadDistrictByCityId: '<?= base_url('/ajax_controller/findDistrictByCityId') ?>',
		loadWardByDistrictId: '<?= base_url('/ajax_controller/findWardByDistrictId') ?>',
		findStreetByNameUrl: '<?= base_url('/ajax_controller/findStreetByName') ?>',
		updateCoordinatorMapUrl: '<?= base_url('/ajax_controller/updateCoordinator') ?>',
		addSubscribleUrl: '<?= base_url('/ajax_controller/addSubscrible') ?>',
		loadGeoFromAddrUrl: '<?= base_url('/ajax_controller/getGeoFromAddress') ?>',
		loadCaptchaUrl: '<?= base_url('/ajax_controller/getCaptchaImg') ?>',
		base_url: '<?=base_url()?>',
		loadPrice4Package: '<?=base_url('/ajax_controller/loadPrice4Package')?>'

	};
</script>
<script src="<?php echo base_url()?>js/mcustome.js"></script>
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "WebSite",
    "url": "http://tindatdai.com",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "http://tindatdai.com/tim-kiem.html?query={search_term_string}",
      "query-input": "required name=search_term_string"
    },
    "name": "tindatdai.com",
    "alternateName": "Tindatdai - Bất Động Sản - Mua Bán Chung Cư, Nhà Đất"
}
</script>
