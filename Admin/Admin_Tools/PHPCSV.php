<?php

  require_once('../Upload.php');

  $database = mysqli_connect('localhost', 'root', 'root', 'timezone_bd');

  $str = "SELECT * FROM `AllClock`";
  $result = mysqli_query($database, $str);
  
  if ($result === false) {

    $str = "CREATE TABLE `allclock` %s";
    $str2 = "(" . 
    "`id` INT AUTO_INCREMENT PRIMARY KEY, " . 
    "`model` TEXT, " . 
    "`price` TEXT, " . 
    "`opisanie` TEXT, " . 
    "`link_img` TEXT" . 
    ")";
    
    $format = sprintf($str, $str2);
    mysqli_query($database, $format);

    echo 'Была создана таблица';

  }

  function readCsv($arg) {

    GLOBAL $database;

    function removeSpace($arg) {
      
      if ($arg !== '') {
        return $arg;
      }

    }

    $f = fopen($arg, 'r');
    $fstring = fread($f, filesize($arg));
    $farray = explode("\n", $fstring);

    array_shift($farray);
    array_pop($farray);

    $IntCount = count($farray);

    for ($x = 0; $x < count($farray); $x++) {
      
      $str = "SELECT * FROM `allclock` WHERE model = '%s'";
      $All = explode(';', $farray[$x]);
      $format = sprintf($str, $All[0]);

      $res = mysqli_query($database, $format);
      $res = mysqli_fetch_all($res);

      if (count($res) !== 0) {
        array_splice($farray, $x, 1, '');
      }

    }

    $farray = array_filter($farray, "removeSpace");
    $continue_iter = 0;

    for ($y = 0; $y < count($farray); $y++) {

      $All = explode(';', $farray[$y]);
      $info_clock = substr($All[2], 0, strpos($All[2], ', ', strpos($All[2], 'стекло:')));

      if ($info_clock === '')
      {
        $continue_iter++;
        continue;
      }

      $All[2] = str_replace($info_clock . ', ', '', $All[2]);
      
      if ( mb_substr($All[2], mb_strlen($All[2]) - 1) !== '.' ) $All[2] .= '.';
      
      $str = "INSERT INTO `allclock` (%s) VALUES (%s)";
      $columns_str = "`model`, `gender`, `country`, `mechanism_type`, " . 
      "`water_resistance`, `glass`, `price`, `opisanie`, `link_img`";
      $values_str = "'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'";
      
      $info_clock = explode(', ', $info_clock);
      $info_clock[4] = str_replace('стекло: ', '', $info_clock[4]);

      $values_str = sprintf(
        $values_str,
        $All[0],
        $info_clock[0],
        $info_clock[1],
        $info_clock[2],
        $info_clock[3],
        $info_clock[4],
        $All[1],
        $All[2],
        $All[3] 
      );

      $str = sprintf($str, $columns_str, $values_str);
      mysqli_query($database, $str);

      $date_next_month = date('d.m.Y', time() + (60 * 60 * 24 * 30));
      $str = "INSERT INTO `clocks_tags` (`model`, `tag`, `date_delete`) VALUES ('%s', '%s', '%s')";
      $str = sprintf($str, $All[0], "NEW", $date_next_month);
      mysqli_query($database, $str);

    }

    if ($continue_iter > 0)
    {
      while ($continue_iter !== 0)
      {
        $y--;
        $continue_iter--;
      }

      unset($continue_iter);
    }

    echo 'Было загружено ' . $y . ' строк!';
    
    if ($y !== 0) {
      echo 'Таблица была обновлена!';
    }

    $str = "SELECT * FROM `allclock`";
    $res = mysqli_query($database, $str);
    $res = mysqli_fetch_all($res);

    $start = rand(0, count($res));
    $data = [];

    for ($i = 0; $i < $start; $i++)
    {
      $elem = rand(1, count($res));

      if (array_search($elem, $data))
      {
        while (!array_search($elem, $data))
        {
          $elem = rand(1, count($res));
        }
      }

      $discount = rand(1, 99);
      $elem = $res[$elem - 1];

      $get_time = date('d.m.Y', time() + 60 * 60 * 24 * rand(1, 30));
      echo $get_time . "\n";

      $str = "INSERT INTO `clocks_tags` (`model`, `tag`, `date_delete`, `discount`) VALUES ('%s', '%s', '%s', '%s')";
      $str = sprintf($str, $elem[1], "SALE", $get_time, $discount);
      //mysqli_query($database, $str);
    }

  }

  for ($i = 0; $i < count($list); $i++) {

    if ($list[$i] === $_POST['name']) {
      readCsv($_SERVER['DOCUMENT_ROOT'] . '/ClockCsv/' . $list[$i]);
      break;
    }

  }

?>