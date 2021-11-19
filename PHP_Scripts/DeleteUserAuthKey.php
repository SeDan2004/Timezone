<?php 

  $database = mysqli_connect('localhost', 'root', 'root', 'timezone_bd');

  function Delete_Key()
  {
    GLOBAL $database;

    function StrToNum($arg)
    {
      return (int)$arg;
    }

    $current_date = time();
    $str = "SELECT * FROM `auth_keys` WHERE date_delete";

    $result = mysqli_query($database, $str);
    $result = mysqli_fetch_all($result);

    for ($i = 0; $i < count($result); $i++)
    {
      $date = $result[$i][3];
      $str_date = $date;

      $date = explode('.', $date);
      $date = array_map('StrToNum', $date);
      $date = mktime(0, 0, 0, $date[1], $date[0], $date[2]);
      
      if ($current_date >= $date)
      {
        $str = "DELETE FROM `auth_keys` WHERE date_delete = '$str_date'";
        mysqli_query($database, $str);
      }
    }
  }

  Delete_key();

?>