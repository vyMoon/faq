<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">

        <title>start</title>
    </head>

    <h3>Редактирование впороса.</h3>

    <?php foreach ($question as $v) ?>

    <body>
        <form action="./controller/controllerFaq.php" method="post">

            <div>
                <label for="">
                    <input required name="correctedAuthor" type="text" value="<?php echo $v['author'] ?>"> Автор вопроса
                </label>
            </div>

            <div>
                <label for="">
                    <textarea required name="correctedQuestion" id="" cols="60" rows="7"><?php echo $v['question'] ?></textarea> Впорос
                </label>
            </div>

            <div>
                <label for="">
                    <textarea required name="correctedAnswer" id="" cols="60" rows="7"><?php echo $v['answer'] ?></textarea> Ответ
                </label>
            </div>

            <div>
                <label for="">
                    <select name="correctedTheme" size="1">

                        <?php foreach ($themes as $theme) : ?>

                            <?php if ($theme['theme'] == $v['theme']) : ?>

                                <option selected value="<?php echo $theme['id'] ?>"><?php echo $theme['theme'] ?></option>

                            <?php endif ?>

                            <?php if ($theme['theme'] !== $v['theme']) : ?>

                                <option value="<?php echo $theme['id'] ?>"><?php echo $theme['theme'] ?></option>

                            <?php endif ?>
                        <?php endforeach ?> 
                              
                    </select>
                    Тема впороса
                </label>
            </div>

            <div>
                <input type="submit" value="Редактировать">

                <?php foreach($question as $val) : ?>

                    <?php if ($val['display'] !== '1') : ?>

                        <input type="submit" name="publishing" value="Опубликовать">

                    <?php endif ?>

                <?php endforeach ?>
            </div>

        </form>

    </body>
</html>