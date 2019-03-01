<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">

        <title>Вопросы <?php echo $themeName ?></title>
    </head>

    <body>

        <a href="./index.php"><h3>Управление темами</h3></a>

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
                </tr>

            <?php endforeach ?>

        </table>

        
        <?php if (isset($themeQuestions[0])) : ?>

            <h3><?php echo $themeName ?></h3>

            <?php if ($nonAnswered !== 0) : ?>

                <h4>Требуют ответа</h4>

                <?php foreach ($themeQuestions as $question) : ?>

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

            <?php if ($nonAnswered == 0) : ?>

                <h4>Вопросов без ответа нет.</h4>

            <?php endif ?>


            <?php if ($hiden !== 0) : ?>

                <h4>Скрыты</h4>

                <table>
                    <tr>
                        <td><b>Тема</b></td>
                        <td><b>Вопрос</b></td>
                        <td><b>Ответ</b></td>
                        <td><b>Дата</b></td>
                        <td><b>Автор</b></td>
                        <td><b>Почта</b></td>
                    </tr>

                    <?php foreach ($themeQuestions as $question) : ?>

                        <?php if ($question['answer'] !== null && $question['display'] == 0) : ?>

                            <tr>
                                <td><?php echo $question['theme'] ?></td>
                                <td><?php echo $question['question'] ?></td>
                                <td><?php echo $question['answer'] ?></td>
                                <td><?php echo $question['date'] ?></td>
                                <td><?php echo $question['author'] ?></td>
                                <td><?php echo $question['email'] ?></td>
                                <td>
                                    <a href="./controller/controllerFaq.php?published=<?php echo $question['id'] ?>">опубликовать</a>
                                </td>
                                <td>
                                    <a href="./index.php?display=question&question=<?php echo $question['id'] ?>">редактировать</a>
                                </td>
                                <td>
                                    <a href="./controller/controllerFaq.php?dellQuestion=<?php echo $question['id'] ?>">удлать</a>
                                </td>
                            </tr>
                        
                        <?php endif ?>
                    <?php endforeach ?>
                </table>
            <?php endif ?>

            <?php if ($hiden == 0) : ?>

                <h4>Скрытых вопросов нет.</h4>

            <?php endif ?>

            <?php if ($published !== 0) : ?>

                <h4>Опубликованы</h4>

                <table>
                    <tr>
                        <td><b>Тема</b></td>
                        <td><b>Вопрос</b></td>
                        <td><b>Ответ</b></td>
                        <td><b>Дата</b></td>
                        <td><b>Автор</b></td>
                        <td><b>Почта</b></td>
                    </tr>

                    <?php foreach ($themeQuestions as $question) : ?>

                        <?php if ($question['answer'] !== null && $question['display'] == 1) : ?>

                            <tr>
                                <td><?php echo $question['theme'] ?></td>
                                <td><?php echo $question['question'] ?></td>
                                <td><?php echo $question['answer'] ?></td>
                                <td><?php echo $question['date'] ?></td>
                                <td><?php echo $question['author'] ?></td>
                                <td><?php echo $question['email'] ?></td>
                                <td>
                                    <a href="./controller/controllerFaq.php?unpublished=<?php echo $question['id'] ?>">скрыть вопрос</a>
                                </td>
                                <td>
                                    <a href="./index.php?display=question&question=<?php echo $question['id'] ?>">редактировать</a>
                                </td>
                                <td>
                                    <a href="./controller/controllerFaq.php?dellQuestion=<?php echo $question['id'] ?>">удлать</a>
                                </td>
                            </tr>
                        
                        <?php endif ?>
                    <?php endforeach ?>
                </table>

            <?php endif ?>

            <?php if ($published == 0) : ?>

                <h4>Опубликованных вопросов нет.</h4>

            <?php endif ?>

        <?php endif ?>

        <?php if (isset($themeQuestions[0]) == false) : ?>

            <h3>в теме <?php echo $themeName; ?> воросов нет </h3>
            
        <?php endif ?>

        <a href="./controller/controller.php?destroy=session"><h3>выйти</h3></a>

    </body>
</html>