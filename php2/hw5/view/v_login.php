<form action="index.php?c=user&act=login" method="POST">
  <div class="error"><?php print_r($error) ?></div>
  <label for="login">
    Введите имя пользователя: <br> 
    <input id="login" name="login" type="text">
  </label>
  <label for="pass">
    Введите пароль: <br>
    <input id="pass" name="pass" type="password">
  </label>
  <input type="submit" value="Войти">
</form>