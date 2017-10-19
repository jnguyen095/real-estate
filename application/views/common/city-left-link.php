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
	$counter = 1;
	?>
	<div class="block-panel">
		<div class="block-header text-left">NHÀ ĐẤT CÁC THÀNH PHỐ</div>
		<div class="block-body">
			<ul class="city-link">
				<?php
				foreach ($topcityhasproduct as $ct) {
					if($counter < 11) {
						echo '<li><a href="' . base_url() . seo_url($ct->CityName) . '-ct' . $ct->CityID . '.html">' . $ct->CityName . '</a></li>';
					}else if($counter == 11){
						echo '<div id="ctp_left" class="collapse">';
					}else{
						echo '<li><a href="' . base_url() . seo_url($ct->CityName) . '-ct' . $ct->CityID . '.html">' . $ct->CityName . '</a></li>';
					}
					$counter++;
				}
				if($counter > 10){
					echo '</div><a href="javascript:void(0);" class="toggleBtn toggleMore" data-status="open" data-toggle="collapse" data-target="#ctp_left">Xem thêm</a>';
				}
				?>
			</ul>
		</div>
	</div>
	<?php
}
?>
