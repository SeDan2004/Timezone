<?php 

  function callbackfunc($arg)
  {
    global $str;
    if ($arg === $str) return $arg;
  }

  class obj{}
  $object_settings = new obj();
  $link_modules = $_SERVER['DOCUMENT_ROOT'] . '/Modules/';
  $Modules_Dir = scandir($link_modules);
  $Modules_Dir = array_slice($Modules_Dir, 2);

  for ($i = 0; $i < count($Modules_Dir); $i++)
  {

    if ( !is_file($link_modules . $Modules_Dir[$i]) )
    {
      $current_dir = scandir($link_modules . $Modules_Dir[$i]);
      $current_dir = array_slice($current_dir, 2);
      $str = 'settings_' . mb_strtolower($Modules_Dir[$i]) . '.txt';
      
      $res = array_filter($current_dir, 'callbackfunc');
      
      $settings_file = $res[key($res)];

      if ($settings_file !== NULL)
      {
        $file_name = substr($settings_file, 0, strpos($settings_file, '.txt'));
        $settings_file = '/' . $settings_file;
        $settings_file = fopen($link_modules . $Modules_Dir[$i] . $settings_file, 'r');
        $object_settings->$file_name = $settings_file;
      }

    }

  }


  $object_name = [];

  foreach($object_settings as $key => $value)
  {
    $dir = substr($key, strpos($key, '_') + 1);
    $dir[0] = strtoupper($dir[0]);
    $key = '/' . $key;

    if ( !isset($link_obj) ) $link_obj = new obj();
    
    $str = $link_modules . $dir . $key . '.txt';
    
    $file = fread($value, filesize($str));
    $file = str_replace(chr(13) . chr(10), ' ', $file);
    $file = explode(' ', $file);

    if ( $file[count($file) - 1] === '' ) array_pop($file);
    
    for ($i = 0; $i < count($file); $i++)
    {
      [$prop, $value] = explode(':', $file[$i]);
      $link_obj->$prop = $value;
    }

    eval("$$dir = clone " . '$link_obj;');
    $object_name["$dir"] = clone $link_obj;
    $link_obj = NULL;
  }

  if ( $_POST['caller'] === 'admin')
  {
    echo json_encode($object_name);
  }

  function RequireModules($arg, $directory)
  {
    require_once($directory . $arg . '.php');
  }

?>