<?php if(!isset($_SESSION['NSFW'])) $_SESSION['NSFW'] = "0" ?>
<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Categories
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="#">Top content</a></li>
    <li><a href="#">New content</a></li>
    <li><a href="?controller=pages&action=NSFW" class="btn" >NSFW: <?php if($_SESSION['NSFW'] == "1"){ echo "ON"; } else echo "OFF";  ?></a></li>
  </ul>
</div>
