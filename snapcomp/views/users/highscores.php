<div style="width: 300px">
	<ul class="list-group">
		<?php 
			
			foreach($user as $usr){
				echo '<li class="list-group-item" style="width: 300px">'.$usr["USERNAME"].' <span class="badge">'.$usr["NUMOFWINS"].'</span></li>';
			}
		
		?>
	</ul>
</div> 