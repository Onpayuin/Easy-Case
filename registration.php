<?php
// Импортируем библиотеку для работы с Firebase
require_once 'vendor/autoload.php';

// Инициализируем Firebase
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebase_credentials.json');
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

// Получаем ссылку на базу данных
$database = $firebase->getDatabase();

// Получаем данные из формы регистрации
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Сохраняем данные в базе данных Firebase
$database->getReference('users')->push([
    'username' => $username,
    'email' => $email,
    'password' => $password
]);

// Перенаправляем пользователя на страницу успешной регистрации
header('Location: success.php');
exit;
?>
