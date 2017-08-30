<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/28/2017
 * Time: 4:43 PM
 */

?>

<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc><?php echo base_url();?></loc>
		<priority>1.0</priority>
	</url>

	<!-- Your Sitemap -->
	<?php foreach($urlslist as $url) { ?>
		<url>
			<loc><?php echo $url;?></loc>
			<priority>0.5</priority>
		</url>
	<?php } ?>

</urlset>
