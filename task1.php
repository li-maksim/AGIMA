<?php

declare(strict_types = 1);

session_start();

$errorMessage = '';
$successMessage = '';
$prevAnswers = [];

if(isset($_SESSION['error_message'])) {
    $errorMessage = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if(isset($_SESSION['prev_answers'])) {
    $prevAnswers = $_SESSION['prev_answers'];
    unset($_SESSION['prev_answers']);
}

if(isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if(isset($_POST['submit'])) {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $rating = $_POST['rating'];
    $comment = htmlspecialchars($_POST['comment']);

    $sendError = function(string $msg) use ($name, $email, $rating, $comment): never {
        $_SESSION['error_message'] = $msg;
        $_SESSION['prev_answers'] = [
            'name' => $name, 
            'email' => $email, 
            'rating' => $rating, 
            'comment' => $comment
        ];
        header('Location: /');
        exit;
    };

    $regex = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9-]+(\.[A-Za-z]{2,})+$/u';

    match (true) {
        $name === '' => $sendError('Пожалуйста, заполните поле "Имя"'),
        strlen($name) < 2 => $sendError('Слишком короткое имя'),
        $email === '' => $sendError('Пожалуйста, заполните поле "Электронная почта"'),
        preg_match($regex, $email) !== 1 => $sendError('Пожалуйста, напишите корректный адрес электронной почты'),
        $comment === '' => $sendError('Пожалуйста, заполните поле "Комментарий"'),
        strlen($name) > 15 => $sendError('Максимальная длина имени — 15 символов'),
        strlen($comment) > 200 => $sendError('Максимальная длина комментария — 200 символов'),
        strlen($comment) < 4 => $sendError('Слишком короткий комментарий'),
        default => null
    };

    if(!isset($_SESSION['error_message'])) {
        $_SESSION['success_message'] = 'Спасибо за ваше сообщение!';

        $answers = fopen("answers.txt", "a");
        fwrite($answers, "Имя: $name\n");
        fwrite($answers, "Email: $email\n");
        fwrite($answers, "Оценка: $rating\n");
        fwrite($answers, "Комментарий: $comment\n\n");
        fclose($answers);

        header('Location: /');
        exit;
    }
}