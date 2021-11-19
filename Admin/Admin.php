<?php 

  
  $Login = $_COOKIE['nickname'];
  $Password = $_COOKIE['pass'];

  if ($Login !== 'Sergey' || $Password !== 'TZ6')
  {
    header('Location: https://timezone/Admin/index.php');
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='Admin.css'>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js'></script>
    <title>Админка</title>
</head>
<body>

  <div class='header'>

    <input type="button" value="Товары">
    <input type="button" value="Пользователи">
    <input type="button" value="Заказы">

  </div>


  <div class='CsvList'>

    <h2 class='CsvTxt'>Список доступных csv таблиц</h2>
    <div class='CsvTable'></div>

  </div>

  <div class='AllModules'>

    <div class='ModulesDiv'>
      <h2>Модули</h2>
      <div>
      <h2>></h2>
      </div>
    </div>

  </div>

    <script src='Admin.js'></script>
</body>
</html>