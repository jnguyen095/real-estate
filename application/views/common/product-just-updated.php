<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 9/14/2017
 * Time: 10:05 AM
 */

if(isset($justUpdatedProducts)) {
	?>

	<div class="inews-l brief mobile-hide">
		<div class="inews-l-title">
			<h3 class="title"><a href="/nha-mau-dep.html" title="Tin Bất Động Sản">MỚI CẬP NHẬT</a></h3>
			<div class="clear-both"></div>
		</div>
		<div class="inews-l-content">
			<ul>
				<?php
				foreach ($justUpdatedProducts as $product) {
					?>
					<li>
						<div class="row">
							<div class="col-md-3 col-xm-12 no-padding-right">
								<img class="width100pc" alt="<?=$product->Title?>" src="<?=$product->Thumb?>"/>
							</div>
							<div class="col-md-9 col-xm-12">
								<h3 class="margin-top-5"><a href="<?=seo_url($product->Title).'-p'.$product->ProductID.'.html'?>"><?=substr_at_middle($product->Title, 100)?></a></h3>
							</div>
						</div>
					</li>
					<?php
				}
				?>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<?php
}
?>
