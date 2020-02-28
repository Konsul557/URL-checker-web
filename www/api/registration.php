<?php

require ('conn.php');

$email_ar = [];
$user_name = $_POST['user_name'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = $pdo->query("SELECT * FROM `users`");
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    array_push($email_ar, $row['email']);
}
if (in_array($email, $email_ar)) {
    echo "Вы уже зарегистрированны";
} else {
    $sql = "INSERT INTO users(user_name, email, password) VALUES(:user_name, :email, :password)";
    $query = $pdo->prepare($sql);
    $query->execute(['user_name' => $user_name, 'email' => $email,'password' => $password]);   //регистрация
    echo 'Регистрация успешна';
}