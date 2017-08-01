<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/19/2017
 * Time: 11:17 AM
 */

?>

<div class="footer row no-margin">
		<?php
		$index = 1;
		foreach($categories as $r) {
			if($index == 1){
				echo '<div class="row no-margin">';
			}
			if(count($child[$r->CategoryID]) > 0){
				echo '<div class="row col-md-3"><div class="catTitle">'.$r->CatName.'</div><ul>';
				foreach ($child[$r->CategoryID] as $k){
					echo '<li><a href="'.base_url().seo_url($k->CatName).'-c'.$k->CategoryID. '.html">'.$k->CatName.'</a></li>';
				}
				echo '</ul></div>';
			}else{
				echo '<div class="row col-md-3">'.$r->CatName.'</div>';
			}

			if($index == 4){
				echo '</div>';
				$index = 1;
			}else{
				$index++;
			}
		}
		if($index != 1){
			echo '</div>';
		}
		?>
		</ul>
</div>
