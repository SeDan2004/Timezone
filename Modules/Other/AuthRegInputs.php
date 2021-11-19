<?php
 $path = '/Modules/Other/AuthAndRegForm.php';
?>
<link rel='stylesheet' href='/Static/Other/AuthRegInputs.css'>
<div class='LogReg col-1'>

  <?php

    if ( !isset($_SESSION['login']) && !isset($_SESSION['password']) )
    {
  ?>

  <a class='Auth' href=<?php echo $path . '/?form=auth' ?>>Войти</a>
  <a class='Register' href=<?php echo $path . '/?form=reg' ?>>Зарегистрироваться</a>
  
  <?php
    }
    else 
    {

  ?>

  <div class='UserLinkAndExit'>
    
    <a class='UserLink'>Личный кабинет</a>
    <p class='ExitUser'>Выйти</p>

  </div>

  <?php 
    }
  ?>

</div>