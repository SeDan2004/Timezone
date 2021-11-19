<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous">
    </script>
    <link rel='stylesheet' href=<?php echo '/Admin/index.css';?>>
    <title>Авторизация</title>
</head>
<body>

    <center>
      <h1 class='HiAdmin'>Привет Админ!</h1>
    </center>

  <div class='AuthForm'>

    <div class='Auth'>
      <h2>Логин: </h2>
      <input type='text' placeholder='Введите логин'>
    </div>

    <div class='Pass'>
      <h2>Пароль: </h2>
      <input type='password' placeholder='Введите пароль'>
    </div>

    <div class='ButtonDiv'>
      <h2 class='AcceptButton'>Продолжить</h2>
    </div>

  </div>

  <script src='/Admin/index.js'></script>

</body>
</html>