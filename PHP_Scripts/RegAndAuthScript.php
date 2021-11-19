<?php
  session_start();
  $database = mysqli_connect('localhost', 'root', 'root', 'timezone_bd');
  
  function Reg()
  {

    $values = $_POST['values'];
    GLOBAL $database;

    $str = "SELECT * FROM `timezone_users` WHERE login = '%s' AND password = '%s'";
    $format = sprintf($str, $values[0], $values[1]);
    $res = mysqli_query($database, $format);
    $res = mysqli_fetch_all($res);

    if (count($res) > 0)
    {
      echo json_encode('данный пользователь уже существует!');
      return;
    }

    $str = "INSERT INTO `timezone_users` (`login`, `password`, `e-mail`, `phone`) VALUES ('%s', '%s', '%s', '%s')";
    $format = sprintf($str, $values[0], $values[1], $values[2], $values[3]);
    $result = mysqli_query($database, $format);

    $_SESSION['login'] = $values[0];
    $_SESSION['password'] = $values[1];

    echo json_encode(true);

  }

  function Auth()
  {
    GLOBAL $database;

    $str = "SELECT * FROM `timezone_users` WHERE login = '%s' AND password = '%s'";
    $format = sprintf($str, $_POST['values'][0], $_POST['values'][1]);
    
    $res = mysqli_query($database, $format);
    $res = mysqli_fetch_all($res);

    if (count($res) === 0)
    {
      echo json_encode('Такого пользователя не существует!');
    }
    else 
    {

      $_SESSION['login'] = $_POST['values'][0];
      $_SESSION['password'] = $_POST['values'][1];

      if ($_POST['values'][2] === 'true')
      {
        $id_user = $res[0][0];
        $date_delete = $_POST['date_delete'];
        $byte = random_bytes(25);
        $str_key = md5($byte);

        $str = "SELECT * FROM `auth_keys` WHERE auth_key = '%s'";
        $format = sprintf($str, $str_key);
        $res = mysqli_query($database, $format);
        $res = mysqli_fetch_all($res);
           
        while (count($res) !== 0)
        {
          $byte = random_bytes(25);
          $str_key = md5($byte);

          $str = "SELECT * FROM `auth_keys` WHERE auth_key = '$str_key'";
          $res = mysqli_query($database, $str);
          $res = mysqli_fetch_all($res);
        }

        $str = "INSERT INTO `auth_keys` (`auth_key`, `user_id`, `date_delete`) VALUES ('%s', '%s', '%s')";
        $format = sprintf($str, $str_key, $id_user, $date_delete);
        $res = mysqli_query($database, $format);

        setcookie('auth_key', $str_key, time()+604800, '/');

        echo json_encode(true);
  
      }
      else 
      {
        echo json_encode(true);
      }

    }

  }

  $_POST['type'] === 'reg' ? Reg() : Auth();

?>