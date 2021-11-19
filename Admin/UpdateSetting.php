<?php 
  
    /*
      Найти файл в котором лежат текущие настройки
      сделать перезапись его свойства
      сохранить результат
    */

    $way = $_SERVER['DOCUMENT_ROOT'] . '/Modules/';
    $Modules_Dir = scandir($way);

    array_shift($Modules_Dir);
    array_shift($Modules_Dir);

    for ($i = 0; $i < count($Modules_Dir); $i++)
    {
      if ( !is_file($way . $Modules_Dir[$i]) )
      {
        $current_dir = scandir($way . $Modules_Dir[$i]);
        $ind = array_search('settings_' . $_POST['file'] . '.txt', $current_dir);

        if ( gettype($ind) === 'integer' )
        {
          $path = $way . $Modules_Dir[$i] . '/' . $current_dir[$ind];
          $replacer = $_POST['prop'] . ':' . $_POST['val'];
          
          $file = fopen($path, 'r');
          $file = fread($file, filesize($path));
          
          $start = strpos($file, $_POST['prop']);
          $end = strpos($file, chr(13));

          $search = substr($file, $start, $end);
          $file = str_replace($search, $replacer, $file);
          
          $file_open = fopen($path, 'w');
          $file_open = fwrite($file_open, $file);
          fclose($file_open);


        }

      }
    }

?>