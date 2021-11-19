<?php

  session_start();

  if ( count($_GET) === 0 || isset($_SESSION['login']) || isset($_SESSION['password']) )
  {
    header("location: https://timezone/");
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='/Static/Other/AuthAndRegForm.css'>
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <title>Привет пользователь Timezone</title>
</head>
<body>

<div class='Header'>
  <p class='WelcomeTxt'>Привет пользователь Timezone</p>
  <div style='width: 38%'></div>
  <p class='Home'>На главную</p>

  <?php 
    if ($_GET['form'] === 'reg')
    {
  ?>
    <p class='AuthLink AuthAndRegLink'>Авторизация</p>
  <?php 
    }
    else 
    {
  ?>
    <p class='RegLink AuthAndRegLink'>Регистрация</p>
  <?php
    }
  ?>

</div>

<div class='CentralDiv'>
<?php
  if ($_GET['form'] === 'auth')
  {
?>

  <p class='AuthTxt'>Поле для авторизации</p>
  <div class='Form'>

    <p class='TxtForm'>Заполните форму</p>
    <div class='ContentBoxAuth'>

      <div class='LoginDiv'>
        <p>Логин:</p>
        <input type='text' placeholder='Введите имя'>
      </div>

      <div class='PassDiv'>
        <p>Пароль:</p>
        <input type='password' placeholder='Введите пароль'>
      </div>

      <div class='CheckboxDiv'>
        <p>Запомнить меня</p>
        <input type='checkbox'>
      </div>

    </div>

  </div>
  <h2 class='Warning'></h2>
  <input type='button' class='InputAccept' value='Подтвердить'>

<?php 
  }
  else 
  {
?>

<p class='RegTxt'>Поле для регистрации</p>
<div class='Form'>

  <p class='TxtForm'>Заполните форму</p>
  <div class='ContentBoxReg'>

    <div class='LeftDiv'>

      <p>Логин:</p>
      <input type='text' placeholder='Введите имя'>
      <p>Пароль:</p>
      <input type='password' placeholder='Введите пароль'>
      <p>Повторите пароль:</p>
      <input type='password' placeholder='Повторите пароль'>

    </div>
    <div class='RightDiv'>
      
      <p>E-Mail (Не обязательно):</p>
      <input type='text' placeholder='Введите E-Mail'>
      <div class='NumberPhone'>

        <p>+</p>
        <input type='text'>
        <p>-</p>
        <input type='text'>
        <p>-</p>
        <input type='text'>
        <p>-</p>
        <input type='text'>
        <p>-</p>
        <input type='text'>

      </div>

      <h4 class='PhoneNumberTxt'>Номер телефона</h4>

    </div>

  </div>

</div>
<h2 class='Warning'></h2>
<input type='button' value='Подтвердить' class='InputAccept'>

<?php 
  }
?>

</div>

<script src='/Static/Other/AuthAndRegForm.js'></script>
</body>
</html>