<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">

        <title>Авторизация</title>
    </head>

    <body>

        <h2>Авторизация</h2>
        <p> <?php echo $messageLogin ?></p>
        <form action="" method="post">
            <input required type="text" name="loginLog" placeholder="login">
            <input required type="text" name="passLog" placeholder="password">
        <input type="submit" value="Войти">
        </form>

    </body>
</html>