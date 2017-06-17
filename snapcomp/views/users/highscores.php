<div style="width: 100px">
	<ul class="list-group">
		<?php 
			
			foreach($user as $usr){
				echo '<li class="list-group-item" style="width: 100px">'.$usr["USERNAME"].' <span class="badge">'.$usr["NUMOFWINS"].'</span></li>';
			}
		
		?>
	</ul>
</div> 