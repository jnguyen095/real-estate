<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/27/2017
 * Time: 11:11 PM
 */

?>
<?php
if(isset($topdistricthasproduct) && count($topdistricthasproduct) > 0){
	?>
	<div class="block-panel">
		<div class="block-header text-left">NHÀ ĐẤT CÁC QUẬN</div>
		<div class="block-body">
			<ul class="city-link">
				<?php
				foreach ($topdistricthasproduct as $dt) {
					echo '<li><a href="' . base_url() . seo_url($dt->DistrictName) . '-dt' . $dt->DistrictID . '.html">' . $dt->DistrictName . '</a></li>';
				}
				?>
			</ul>
		</div>
	</div>
	<?php
}
?>
