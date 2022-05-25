<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .panel {
            margin: 0 auto;
            width: 500px;
            height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

    </style>
</head>
<body>
    <div class="log_out">
        <form action="/login/log_out.php" method="GET">
            <button type="submit">Выйти</button>
        </form>
    </div>
    <div class="panel">
        <h2>Панель администратора</h2>
        <h3><?= $user['username'] ?></h3>
        <h3><?= $user['email'] ?></h3>
        <h3><?= $user['birthday'] ?></h3>
    </div>
</body>
</html>