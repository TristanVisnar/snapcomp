<div class="row">
  <div class="col" style="width:500px">
    <ul class="list-group">
      <li style="padding-top:0px; padding-bottom:0px" class="list-group-item">
        <font size="5px">&nbsp;<?php echo $slika["ID_SUGGESTION"];?> (Theme)</font>
      </li>
      <li style="padding:0px;" class="list-group-item">
        <img src="data:image/png;base64,<?php echo base64_encode( $slika["CONTENT"] );?>" alt="" width="100%" height="350px"/>';
        <!--<img src="http://coolwildlife.com/wp-content/uploads/galleries/post-3004/Fox%20Picture%20003.jpg" alt="" width="100%" height="350px">-->
      </li>

      <li class="list-group-item">
        <b>VOTE:&nbsp;</b>
        <button style="margin-bottom:4px" class="btn btn-success btn-xs glyphicon glyphicon-arrow-up"></button>
        <?php
         echo "234";
        ?>
        <button style="margin-bottom:4px" class="btn btn-danger btn-xs glyphicon glyphicon-arrow-down"></button>
        &nbsp;&nbsp;&nbsp;&nbsp;<b>WINNER: </b> username
        <div style="float:right; margin-top:1px">&nbsp;&nbsp;<b>NAME: </b>Room12345</div>
      </li>
    </ul>
  </div>
</div>
