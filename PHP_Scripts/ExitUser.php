<?php 
  session_start();
  session_unset();
  session_destroy();

  if ( isset($_COOKIE['auth_key']) )
  {
    $current_user_key = $_COOKIE['auth_key'];    
    $database = mysqli_connect('localhost', 'root', 'root', 'timezone_bd');

    setcookie('auth_key', '', time()-3600, '/');
    
    $str = "DELETE FROM `auth_keys` WHERE auth_key = '%s'";
    $format = sprintf($str, $current_user_key);
    mysqli_query($database, $format);

  }
?>