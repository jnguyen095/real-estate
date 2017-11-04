<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 9/23/2017
 * Time: 10:21 AM
 */
?>
<?php
if(isset($branch)){
	?>
	<div class="branch-item">
		<div class="listing-card ">
			<a href="<?=base_url() . seo_url($branch->BrandName) . '-b' . $branch->BrandID ?>.html" title="<?=$branch->BrandName?>" class="listing-card-link listing-img-a">
				<img alt="<?=$branch->BrandName?>" src="<?=$branch->Thumb?>">
			</a>
			<div class="listing-card-info">
				<h3><a href="<?=base_url() . seo_url($branch->BrandName) . '-b' . $branch->BrandID ?>.html" title="<?=$branch->BrandName?>"
					   class="listing-card-link"><?=$branch->BrandName?></a></h3>
				<p class="listing-location"><?=$branch->Description?></p>
			</div>

			<div class="branch-detail">
				<?php
				if(isset($branch->Price) && $branch->Price > 0) {
					?>
					<div class="row">
						<div class="col-xs-4 text-right no-padding">Gía từ:</div>
						<div class="col-xs-8"><?= $branch->Price ?></div>
					</div>
					<?php
				}
				?>
				<?php
				if(isset($branch->Price) && $branch->Area > 0) {
					?>
					<div class="row">
						<div class="col-xs-4 text-right no-padding">Diện tích:</div>
						<div class="col-xs-8"><?=$branch->Area?></div>
					</div>
					<?php
				}
				?>
				<?php
				if(isset($branch->Price) && count($branch->Process) > 0) {
					?>
					<div class="row">
						<div class="col-xs-4 text-right no-padding">Tiến độ:</div>
						<div class="col-xs-8"><?=$branch->Process?></div>
					</div>
					<?php
				}
				?>
				<?php
				if(isset($branch->Price) && count($branch->Owner) > 0) {
					?>
					<div class="row">
						<div class="col-xs-4 text-right no-padding">Chủ đầu tư:</div>
						<div class="col-xs-8"><?=$branch->Owner?></div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}
?>
