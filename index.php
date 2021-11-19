<?php

  $link = $_SERVER['DOCUMENT_ROOT'];
  $ColorTheme = $_COOKIE['color'];  
  

  if ( !isset($_GET['route']) )
  {
    require_once($link . '/Templates/index.php');
  }
  else
  {
    require_once('route.php');
  }

?>