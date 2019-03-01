<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Управление</title>
    </head>

    <body>

        <h3>Темы</h3>

        <p><a href="./index.php?display=faq">FAQ</a></p>
        
        <form action="./controller/controllerTheme.php" method="post">

            <input required type="text" name="newTheme" placeholder="название">
            <input type="submit" value="Создать тему">
        
        </form>

        <table>

            <td></td>
            <td>Всего вопросов</td>
            <td>Без ответа</td>
            <td>Опубликовано</td>

            <?php foreach ($themes as $theme) : ?>

                <?php $themeId = $theme['id']; $this->faqClass->countQuestion($themeId); ?>

                <tr>
                    <td>
                        <a href="index.php?display=theme&theme=<?php echo $theme['theme']; ?>">
                            <?php echo $theme['theme']; ?>
                        </a>
                    </td>
                    <td><?php echo $this->faqClass->allCount; ?></td>
                    <td><?php echo $this->faqClass->nullAnswer; ?></td>
                    <td><?php echo $this->faqClass->countPublished; ?></td>
                    <td>
                        <a href="./controller/controllerTheme.php?dellTheme=<?php echo $theme['id']; ?>">
                            удалить тему и все вопросы этой темы
                        </a>
                    </td>
                </tr>

            <?php endforeach ?>

        </table>

        <?php if ($id == 1) : ?>

            <h3>Администраторы</h3>

            <p><?php echo $message; ?></p>

            <form action="" method="post">

                <input required type="text" name="newAdmin" placeholder="login">
                <input required type="text" name="newPass" placeholder="pass">
                <input type="submit" value="Создать">

            </form>

            <?php if (count($admins) > 1) : ?>

                <table>

                    <tr>
                        <td>
                            <h4>Администратор</h4>
                        </td>
                        <td>
                            <h4>Изменить пароль администратора</h4>
                        </td>
                        <td>
                            <h4>Удалить администратора</h4>
                        </td>
                    </tr>
                    
                    <?php foreach ($admins as $admin) : ?>

                        <?php if ($admin['login'] !== 'admin') : ?>

                            <tr>
                                <td>
                                    <?php echo $admin['login'] ?>
                                </td>
                                <td>
                                    <form action="./controller/controllerUser.php" method="post">

                                        <input required type="text" name="<?php echo $admin['id'] ?>changedPassAdmin" placeholder="новый пароль">
                                        
                                        <input type="submit" value="изменить пароль">
                                    </form>
                                </td>
                                <td>
                                    <a href="./controller/controllerUser.php?deletedAdmin=<?php echo $admin['id'] ?>">удалить администратора</a>
                                </td>
                            </tr>

                        <?php endif ?>
                    <?php endforeach ?>
                    
                </table>
            <?php endif ?>
        <?php endif ?>


        <?php if ($nonAnswered !== 0) : ?>

            <h3>Вопросы без ответа</h3>

            <?php foreach($questions as $question) : ?>

                <?php if ($question['answer'] == null) : ?>

                    <table>

                        <tr>
                            <td><b>Тема</b></td>
                            <td><b>Вопрос</b></td>
                            <td><b>Дата</b></td>
                            <td><b>Автор</b></td>
                            <td><b>Почта</b></td>
                        </tr>

                        <tr>
                            <td><?php echo $question['theme'] ?></td>
                            <td><?php echo $question['question'] ?></td>
                            <td><?php echo $question['date'] ?></td>
                            <td><?php echo $question['author'] ?></td>
                            <td><?php echo $question['email'] ?></td>
                            <td>
                                <a href="./index.php?display=question&question=<?php echo $question['id'] ?>">редактировать</a>
                            </td>
                            <td>
                                <a href="./controller/controllerFaq.php?dellQuestion=<?php echo $question['id'] ?>">удлать</a>
                            </td>
                        </tr>

                    </table>

                    <h5>Быстрый ответ</h5>

                    <form action="./controller/controllerFaq.php" method="post">

                        <textarea required name="<?php echo $question['id'] ?>quickAnswer" id="" cols="80" rows="1"></textarea>
                        <input type="submit" value="Ответить">
                        <input type="submit" name="publishing" value="Ответить и опубликовать">

                    </form>

                <?php endif ?>
            <?php endforeach ?>
        <?php endif ?>

        <a href="./controller/controllerSession.php?destroy=session"><h3>выйти</h3></a>

    </body>
</html>