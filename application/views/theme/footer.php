<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/19/2017
 * Time: 11:17 AM
 */

?>

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
				}
				$counter++;
			}
			echo '</ul></div>';
		}
		?>
		<div class="clear-both"></div>
	</div>
	<div class="menu_bottom">
		<ul>
			<li><a href="#">Báo giá quảng cáo</a></li>
			<li><a href="<?=base_url('/dieu-khoan-su-dung.html')?>">Điều khoản thỏa thuận</a></li>
			<li><a href="<?=base_url('/quy-che-hoat-dong.html')?>">Quy chế hoạt động</a></li>
			<li><a href="#">Câu hỏi thường gặp</a></li>
			<li><a href="#">Hỗ trợ - góp ý</a></li>
			<li><a href="#">Tuyển dụng</a></li>
			<li><a href="#">Rss</a></li>
		</ul>
	</div>
	<div class="copyright text-center">
		<div>Copyright © 2017 tindatdai.vn ® Ghi rõ nguồn "tindatdai.com" khi phát hành lại thông tin từ website này.</div>
		<div>Hotline: 0982.647.619 | Email: tindatdai@gmail.com | <a rel="nofollow" href="skype:nhukhang095?chat" title="Chát với http://tindatdai.com"><img src="<?=base_url('/img/skype.png')?>"/></a> </div>
	</div>
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
	};
</script>
<script src="<?php echo base_url()?>js/mcustome.js"></script>
