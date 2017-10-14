<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/27/2017
 * Time: 11:11 PM
 */

?>
<?php
if(isset($cityWithCats) && count($cityWithCats) > 0){
	?>
	<div class="block-panel">
		<div class="block-header text-left"><?=$category->CatName?> tại thành phố:</div>
		<div class="block-body">
			<ul class="city-link">
				<?php
				$counter = 1;
				foreach ($cityWithCats as $ct) {
					if($counter < 11) {
						echo '<li><a href="' . base_url(seo_url($category->CatName . '-' . $ct->CityName)) . '-cc' . $category->CategoryID . '-' . $ct->CityID . '.html">' . $ct->CityName . '</a> <span class="result-count">['.$ct->Total. ']</span></li>';
					}else if($counter == 11){
						echo '<div id="ctt_'.$category->CategoryID.'" class="collapse">';
					}else{
						echo '<li><a href="' . base_url(seo_url($category->CatName . '-' . $ct->CityName)) . '-cc' . $category->CategoryID . '-' . $ct->CityID . '.html">' . $ct->CityName . '</a> <span class="result-count">['.$ct->Total. ']</span></li>';
					}
					$counter++;
				}
				if($counter > 10){
					echo '</div><strong>.:</strong>&nbsp;<a href="javascript:void(0);" class="toggleBtn toggleMore" data-status="open" data-toggle="collapse" data-target="#ctt_'.$category->CategoryID.'">Xem thêm</a>';
				}
				?>
			</ul>
		</div>
	</div>
	<?php
}
?>
