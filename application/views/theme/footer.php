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
			foreach ($footerMenu['child'] as $ch){
				echo '<li><a href="'.base_url().seo_url($ch->CatName).'-'.seo_url($ch->CityName).'-cc'.$ch->CategoryID.'-'.$ch->CityID.'.html">'.$ch->CatName.' '. $ch->CityName.'</a></li>';
			}
			echo '</ul></div>';
		}
		?>
		<div class="clear-both"></div>
	</div>
	<div class="menu_bottom">
		<ul>
			<li><a href="#">Báo giá quảng cáo</a></li>
			<li><a href="#">Điều khoản thỏa thuận</a></li>
			<li><a href="#">Quy chế hoạt động</a></li>
			<li><a href="#">Câu hỏi thường gặp</a></li>
			<li><a href="#">Hỗ trợ - góp ý</a></li>
			<li><a href="#">Tuyển dụng</a></li>
			<li><a href="#">Rss</a></li>
		</ul>
	</div>
	<div class="copyright text-center">
		<div>Copyright © 2017 tindatdai.vn ® Ghi rõ nguồn "tindatdai.com" khi phát hành lại thông tin từ website này.</div>
		<div>Hotline: 0982.647.619 | Email: tindatdai@gmail.com</div>
	</div>
	<a style="display: none" href="http://backlinks.vn" target="_blank" title="free auto backlink, tao backlink, tao backlink chat luong cao mien phi" rel="dofollow"><img src="http://backlinks.vn/backlink.gif" alt="free auto backlink, tao backlink, tao backlink chat luong cao mien phi" width="80" height="15" border="0" /></a>
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
		updateCoordinatorMapUrl: '<?= base_url('/ajax_controller/updateCoordinator') ?>'
	};
</script>
<script src="<?php echo base_url()?>js/mcustome.js"></script>
