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
				$counter = 1;
				foreach ($topbranchhasproduct as $br) {
					if($counter < 11) {
						echo '<li><a href="' . base_url() . seo_url($br->BrandName) . '-b' . $br->BrandID . '.html">' . $br->BrandName . '</a></li>';
					}else if($counter == 11){
						echo '<div id="br_left" class="collapse">';
					}else{
						echo '<li><a href="' . base_url() . seo_url($br->BrandName) . '-b' . $br->BrandID . '.html">' . $br->BrandName . '</a></li>';
					}
					$counter++;
				}
				if($counter > 10){
					echo '</div><a href="javascript:void(0);" class="toggleBtn toggleMore" data-status="open" data-toggle="collapse" data-target="#br_left">Xem thêm</a>';
				}
				?>
			</ul>
		</div>
	</div>
	<?php
}
?>
