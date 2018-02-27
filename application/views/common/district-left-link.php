<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/27/2017
 * Time: 11:11 PM
 */

?>
<?php
if(isset($districtWithCategory) && count($districtWithCategory) > 0){
	$counter = 1;
	?>
	<div class="block-panel">
		<div class="block-header text-left"><?=$category->CatName?> tại quận:</div>
		<div class="block-body">
			<ul class="city-link">
				<?php
				foreach ($districtWithCategory as $dt) {
					if($counter < 11) {
						echo '<li><a href="' . base_url() . seo_url($category->CatName . '-' . $dt->DistrictName) . '-c' . $category->CategoryID . '-d' . $dt->DistrictID . '.html">' . $dt->DistrictName . '</a><span class="result-count">[' . $dt->Total . ']</span></li>';
					}else if($counter == 11){
						echo '<div id="cdt_left" class="collapse">';
					}else{
						echo '<li><a href="' . base_url() . seo_url($category->CatName . '-' . $dt->DistrictName) . '-c' . $category->CategoryID . '-d' . $dt->DistrictID . '.html">' . $dt->DistrictName . '</a><span class="result-count">[' . $dt->Total . ']</span></li>';
					}
					$counter++;
				}
				if($counter > 11){
					echo '</div><a href="javascript:void(0);" class="toggleBtn toggleMore" data-status="open" data-toggle="collapse" data-target="#cdt_left">Xem thêm</a>';
				}
				?>
			</ul>
		</div>
	</div>
	<?php
}else if(isset($topdistricthasproduct) && count($topdistricthasproduct) > 0){
	?>
	<div class="block-panel">
		<div class="block-header text-left">NHÀ ĐẤT CÁC QUẬN</div>
		<div class="block-body">
			<ul class="city-link">
				<?php
				$counter = 1;
				foreach ($topdistricthasproduct as $dt) {
					if ($counter < 11) {
						echo '<li><a href="' . base_url() . seo_url($dt->DistrictName) . '-dt' . $dt->DistrictID . '.html">' . $dt->DistrictName . '</a></li>';
					} else if ($counter == 11) {
						echo '<div id="cdt1_left" class="collapse">';
					} else {
						echo '<li><a href="' . base_url() . seo_url($dt->DistrictName) . '-dt' . $dt->DistrictID . '.html">' . $dt->DistrictName . '</a></li>';
					}
					$counter++;
				}
				if($counter > 11){
					echo '</div><a href="javascript:void(0);" class="toggleBtn toggleMore" data-status="open" data-toggle="collapse" data-target="#cdt1_left">Xem thêm</a>';
				}
				?>
			</ul>
		</div>
	</div>
	<?php
}
?>
