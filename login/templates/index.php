<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .form {
      width: 500px;
      height: 500px;
      margin: 0 auto;
      display: flex;
      justify-content: center;
      flex-direction: column;
    }
    form {
      display: flex;
      justify-content: center;
      flex-direction: column;
    }
    h2 {
      text-align: center;
    }
    input {
      height: 40px;
    }
    button {
      margin-top: 10px;
      height: 40px;
    }
    .error {
        color: red;
        margin: 5px 0 5px 0;
    }
    .remember {
        display: flex;
        align-items: center;
        flex-direction: row-reverse;
    }
  </style>
</head>
<body>
  <div class="form">
    <h2>Авторизация</h2>
    <form action='/login/index.php' method='POST'>
      <label for="username">логин</label>
      <input type='text' name='username' id='username'>
      <label for="password">пароль</label>
      <input type='text' name='password' id='password'>
        <?php if($errors): ?>
            <span class="error"> <?= $errors ?> </span>
        <?php endif ?>
      <div class="remember">
        <label for="remember_me">запомнить меня</label>
        <input type="checkbox" id="remember_me" name="remember">
      </div>
      <button type='submit'>отправить</button>
    </form>
  </div>
</body>
</html>