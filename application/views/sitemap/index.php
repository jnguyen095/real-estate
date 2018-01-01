<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	<url>
		<loc><?php echo base_url();?></loc>
		<lastmod><?=$currentDate?></lastmod>
		<changefreq>daily</changefreq>
		<priority>0.9</priority>
	</url>
	<?php foreach($categorylist as $url) { ?>
		<url>
			<loc><?php echo $url;?></loc>
			<lastmod>2017-12-12</lastmod>
			<changefreq>weekly</changefreq>
			<priority>0.3</priority>
		</url>
	<?php } ?>

</urlset>
