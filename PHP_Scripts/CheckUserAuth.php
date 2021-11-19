<?php 

  function CheckUserAuth()
  {

    $database = mysqli_connect('localhost', 'root', 'root', 'timezone_bd');

    if ( isset($_COOKIE['auth_key']) )
    {
      $auth_key = $_COOKIE['auth_key'];

      $str = "SELECT * FROM `auth_keys` WHERE auth_key = '%s'";
      $format = sprintf($str, $auth_key);
      $result = mysqli_query($database, $format);
      $result = mysqli_fetch_all($result);

      if ( count($result) !== 0 )
      {

        $user_id = $result[0][2];

        $str = "SELECT * FROM `timezone_users` WHERE id = '%s'";
        $format = sprintf($str, $user_id);
        $result = mysqli_query($database, $format);
        $result = mysqli_fetch_all($result);

        $_SESSION['login'] = $result[0][1];
        $_SESSION['password'] = $result[0][2];
      }
      
    }  
  }

  if ( isset($_COOKIE['auth_key']) ) CheckUserAuth();

?>