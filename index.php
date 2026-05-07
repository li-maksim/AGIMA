<?php

include "task1.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Task 1</title>
        <link href="/styles_task1.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <?php if (!empty($successMessage)): ?>
                <p class="success_message"><?= $successMessage ?></p>
            <?php else: ?>
                <form method="post" action="task1.php" class="form">
                    <h1>Форма обратной связи</h1>
                    <div class="fields">
                        <div class="input_wrapper">
                            <label for="input_name" class="label">Имя</label>
                            <input type="text" id="input_name" name="name" maxlength="15" class="input" value="<?= $prevAnswers['name'] ?? '' ?>">
                        </div>
                        <div class="input_wrapper">
                            <label for="email" class="label">Электронная почта</label>
                            <input type="email" id="input_email" name="email" class="input" value="<?= $prevAnswers['email'] ?? '' ?>">
                        </div>
                        <div class="input_wrapper">
                            <label for="input_rating" class="label">Оценка страницы</label>
                            <select id="input_rating" name="rating" class="input select">
                                <?php $rating = $prevAnswers['rating'] ?? '5'; ?>
                                <?php for ($i=0; $i<=5; $i++): ?>
                                    <option value="<?= $i ?>" <?= ($rating === (string)$i) ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="input_wrapper">
                            <label for="input_comment" class="label">Комментарий</label>
                            <textarea id="input_comment" name="comment" rows="10" cols="40" maxlength="200" class="input textarea"><?= $prevAnswers['comment'] ?? '' ?></textarea>
                        </div>
                    </div>
                    <?php if (!empty($errorMessage)): ?>
                        <p class="error"><?= $errorMessage ?></p>
                    <?php endif; ?>
                    <button name="submit" class="btn submit_btn">Отправить</button>
                </form>
            <?php endif; ?>
        </div>
    </body>
</html>