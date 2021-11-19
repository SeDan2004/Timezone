<?php

  switch( $_GET['route'])
  {
      case 'admin':
        require_once($link . '/Admin/index.php');
      break;

      case 'test':
        require_once($link . '/Templates/Test.php');
      break;
  }

?>