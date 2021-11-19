<?php 
  $database = mysqli_connect('localhost', 'root', 'root', 'timezone_bd');
  $current_time = time();

  $str = "SELECT * FROM `clocks_tags`";
  $result = mysqli_query($database, $str);
  $result = mysqli_fetch_all($result);

  for ($i = 0; $i < count($result); $i++)
  {
    $date_delete = $result[$i][3];
    $date_delete = explode('.', $date_delete);
    $date_delete = mktime(0, 0, 0, $date_delete[1], $date_delete[0], $date_delete[2]);
    
    if ($current_time >= $date_delete)
    {
      $str = "DELETE FROM `clocks_tags` WHERE id = '%s'";
      $str = sprintf($str, $result[$i][0]);
      mysqli_query($database, $str);
    }
  }
?>