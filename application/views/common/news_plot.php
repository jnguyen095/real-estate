<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 9/14/2017
 * Time: 10:05 AM
 */

if(isset($topNews)) {
	?>

	<div class="inews-l">
		<div class="inews-l-title">
			<img class="imgIcon" src="<?=base_url('/img/tintuc.png')?>" alt="Nhà đẹp">
			<h3 class="title"><a href="/tin-tuc.html" title="Tin Bất Động Sản">Tin Bất Động Sản</a></h3>
			<div class="clear-both"></div>
		</div>
		<div class="inews-l-content">
			<div class="inews-l-content-hot">
				<a href="<?=seo_url($topNews[0]->Title).'-n'.$topNews[0]->NewsID.'.html'?>">
					<img alt="<?=$topNews[0]->Title?>" src="<?=$topNews[0]->Thumb?>"/>
				</a>
				<h3>
					<a href="<?=seo_url($topNews[0]->Title).'-n'.$topNews[0]->NewsID.'.html'?>"><?=$topNews[0]->Title?></a>
				</h3>
			</div>
			<div class="clear"></div>
			<ul>
				<?php
				foreach ($topNews as $topNew) {
					?>
					<li>
						<a href="<?=seo_url($topNew->Title).'-n'.$topNew->NewsID.'.html'?>"><?=$topNew->Title?></a>
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
