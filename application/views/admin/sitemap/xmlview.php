<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	<url>
		<loc><?php echo base_url();?></loc>
		<lastmod><?=$currentDate?></lastmod>
		<changefreq>daily</changefreq>
		<priority>0.9</priority>
	</url>
	<?php foreach($items as $item) { ?>
	<url>
		<loc><?php echo base_url(seo_url($item->Title)).'-p'.$item->ProductID.'.html'?></loc>
		<lastmod><?=date('Y-m-d', strtotime($item->LastModified))?></lastmod>
		<changefreq><?=$item->ChangeFrequency?></changefreq>
		<priority><?=$item->Priority?></priority>
	</url>
	<?php } ?>

</urlset>
