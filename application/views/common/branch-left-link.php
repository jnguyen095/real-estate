<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/27/2017
 * Time: 11:11 PM
 */

?>
<?php
if(isset($topbranchhasproduct) && count($topbranchhasproduct) > 0){
	?>
	<div class="block-panel">
		<div class="block-header text-left">CÁC DỰ ÁN NỔI BẬT</div>
		<div class="block-body">
			<ul class="city-link">
				<?php
				foreach ($topbranchhasproduct as $br) {
					echo '<li><a href="' . base_url() . seo_url($br->BrandName) . '-b' . $br->BrandID . '.html">' . $br->BrandName . '</a></li>';
				}
				?>
			</ul>
		</div>
	</div>
	<?php
}
?>
