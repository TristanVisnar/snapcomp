<ul class="list-group">
	<?php 
		echo "krneki";
		foreach($user as $usr){
			echo "krneki";
			echo '<li class="list-group-item">'.$usr["USERNAME"].' <span class="badge">'.$usr["NUMOFWINS"].'</span></li>';
		}
	
	?>
</ul> 