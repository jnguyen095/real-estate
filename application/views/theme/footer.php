<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/19/2017
 * Time: 11:17 AM
 */

?>

<div class="footer row no-margin">
	<div class="row no-margin">
		<?php
		foreach($categories as $r) {
			if(count($child[$r->CategoryID]) > 0){
				echo '<div class="row col-md-3"><div class="catTitle">'.$r->CatName.'</div><ul>';
				foreach ($child[$r->CategoryID] as $k){
					echo '<li><a href="'.base_url().seo_url($k->CatName).'-c'.$k->CategoryID. '.html">'.$k->CatName.'</a></li>';
				}
				echo '</ul></div>';
			}else{
				echo '<div class="row col-md-3">'.$r->CatName.'</div>';
			}
		}
		?>
		</ul>
	</div>
</div>
