<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Modules/main.php')?>
<div class='row' style='height: 3rem'>

    <p class='SiteName col-2'>TIMEZONE</p>
    <div class='col-2'></div>
    <div class='col-1'></div>

    <div class='col-4'>
      <?php 
        RequireModules('search', 'Shop/');
      ?>
    </div>

    <div class='col-2'>
      <?php
        RequireModules('backet', 'Shop/'); 
      ?>
    </div>

</div>

<div class='row'>

  <?php
    RequireModules('HeaderClock', 'Other/'); 
    RequireModules('filter', 'Shop/');
  ?>

  <div class='col-4' style='visibility: hidden'></div>
  <div class='col-1' style='visibility: hidden'></div>
  <?php RequireModules('AuthRegInputs', 'Other/')?>

</div>