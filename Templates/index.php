<?php

  session_start();

  require_once($link . '/PHP_Scripts/CheckUserAuth.php');
  require_once($link . '/PHP_Scripts/DeleteUserAuthKey.php');
  require_once('header.php');
  require_once('content.php');

  /* if ($_GET['route'] === 'admin')
  {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/Admin/index.php');
  }

  if ($_GET['route'] === 'test')
  {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/Templates/Test.php');
  } */

?>