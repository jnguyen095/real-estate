<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<?php foreach ($items as $item){?>
	<sitemap>
		<loc><?='https:'.base_url('/sitemap_').$item->SitemapIndexID.'.xml'?></loc>
		<lastmod><?=date('Y-m-d', strtotime($item->LastModified))?></lastmod>
	</sitemap>
	<?php } ?>
</sitemapindex>
