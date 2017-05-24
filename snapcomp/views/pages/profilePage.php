<div style="margin-left: 10px" >
  <h3>Profile Page</h3>
  <p>Some description here</p>
  <hr>
  <div class="media">
        <div class="media-left">
          <img src="https://beebom-redkapmedia.netdna-ssl.com/wp-content/uploads/2016/01/Reverse-Image-Search-Engines-Apps-And-Its-Uses-2016.jpg" class="media-object" width="150px" height="150px">
        </div>
        <div class="media-body">
          <h4 style="padding-bottom:5px;" class="media-heading"><b>Username: </b><font size="3px"><a class="test" href="#" data-toggle="tooltip" data-placement="right" title="Click to edit"><?php echo $user->USERNAME; ?></a></font></h4>
          <h4 style="padding-bottom:10px;" class="media-heading"><b>Account Name: </b><font size="3px"><?php echo $user->ACCNAME; ?></font></h4>
          <button type="button" class="btn btn-primary">Change picture</button>
        </div>
      </div>
      <br>
          <div style="width:355px">
            <h4>User Information: </h4>
            <hr style="margin-top:10px; margin-bottom:10px; background-color:grey; height:1px; border:0;">
          </div>

          <div class="panel panel-info" style="width:350px">
            <div class="panel-heading">First Name:</div>
            <div style="padding-top:2px; padding-bottom:2px;" class="panel-body"><a class="test" href="#" data-toggle="tooltip" data-placement="right" title="Click to edit"><?php echo $user->FIRSTNAME; ?></a></div>

            <div class="panel-heading">Last Name:</div>
            <div style="padding-top:2px; padding-bottom:2px;" class="panel-body"><a href="#" data-toggle="tooltip" data-placement="right" title="Click to edit"><?php echo $user->SURNAME; ?></a></div>

            <div class="panel-heading">Country:</div>
            <div style="padding-top:2px; padding-bottom:2px;" class="panel-body"><a href="#" data-toggle="tooltip" data-placement="right" title="Click to edit"><?php echo $user->COUNTRY; ?></a></div>

            <div class="panel-heading">Date of Birth:</div>
            <div style="padding-top:2px; padding-bottom:2px;" class="panel-body"><a href="#" data-toggle="tooltip" data-placement="right" title="Click to edit"><?php echo $user->DATEOFBIRTH; ?></a></div>

            <div class="panel-heading">Language:</div>
            <div style="padding-top:2px; padding-bottom:2px;" class="panel-body"><a href="#" data-toggle="tooltip" data-placement="right" title="Click to edit"><?php echo $user->LANG; ?></a></div>
			
			<div class="panel-heading">Gender:</div>
            <div style="padding-top:2px; padding-bottom:2px;" class="panel-body"><a href="#" data-toggle="tooltip" data-placement="right" title="Click to edit">
			<?php
				if($user->GENDER == 1)
					echo "Male"; 
				else if($user->Gender == 2){
					echo "Female";
				}
				else 
					echo "Error while reading from database, please try to reload page, or contact the page administrator.";
			?>
			</a></div>
			
			<div class="panel-heading">Number of wins:</div>
            <div style="padding-top:2px; padding-bottom:2px;" class="panel-body"><a href="#" data-toggle="tooltip" data-placement="right" title="Click to edit"><?php echo $user->NUMOFWINS; ?></a></div>
			
			<div class="panel-heading">Number of posts:</div>
            <div style="padding-top:2px; padding-bottom:2px;" class="panel-body"><a href="#" data-toggle="tooltip" data-placement="right" title="Click to edit"><?php echo $user->NUMOFPOSTS; ?></a></div>
          </div>
</div>
