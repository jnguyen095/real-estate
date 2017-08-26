<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/27/2017
 * Time: 11:11 PM
 */

?>
<?php
if(isset($topcityhasproduct) && count($topcityhasproduct) > 0){
	?>
	<div class="block-panel">
		<div class="block-header text-left">NHÀ ĐẤT CÁC THÀNH PHỐ</div>
		<div class="block-body">
			<ul class="city-link">
				<?php
				foreach ($topcityhasproduct as $ct) {
					echo '<li><a href="' . base_url() . seo_url($ct->CityName) . '-ct' . $ct->CityID . '.html">' . $ct->CityName . '</a></li>';
				}
				?>
			</ul>
		</div>
	</div>
	<?php
}
?>
