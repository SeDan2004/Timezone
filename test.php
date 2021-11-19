<?php 

  $database = mysqli_connect('localhost', 'root', 'root', 'timezone_bd');

  class Product {

    function __construct ($id, $database, $table = "default")
    {
      $this->id = $id;
      $this->table = $table;
      $this->load($database);
    }

    function load($db)
    {      
      $str = "SELECT * FROM $this->table WHERE id = $this->id";
      $res = mysqli_query($db, $str);
      //$res1 = mysqli_fetch_all($res);

      
      $res2 = mysqli_fetch_assoc($res);
      //var_dump($res);

      foreach ($res2 as $key => $value)
      {
        $this->$key = $value;
      }

    }

    function GetPrice() 
    {
      return $this->price;
    }

  }

  $clock_1 = new Product(1, 'allclock', $database);
  var_dump($clock_1->GetPrice());

/* while ($row = mysql_fetch_assoc($post)) {
  echo $row['title'];
} */



?>