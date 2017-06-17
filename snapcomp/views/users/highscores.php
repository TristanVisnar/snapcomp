<ul class="list-group">
	<?php 
		foreach($user as $usr ){
			echo '<li class="list-group-item">'.$usr["USERNAME"].' <span class="badge">'.$usr["NUMOFWINS"].'</span></li>';
		}
	
	?>
</ul> 