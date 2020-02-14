<?php
require ('vendor/autoload.php');
use \Firebase\JWT\JWT;

require ('conn.php');

$user_name_ar = [];
$pass_ar = [];
$user_name = $_POST['user_name'];
$password = $_POST['password']; 
$id = '';
$query = $pdo->query("SELECT * FROM `users`");
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    array_push($user_name_ar, $row['user_name']);
    array_push($pass_ar, $row['password']);
    if ($user_name == $row['user_name']) {
        $id = $row['id'];
    }
}

$key = "localhost";

if (in_array($user_name, $user_name_ar) and in_array($password, $pass_ar)) {
    //jwt
    $payload = array(
        "iss" => "localhost",
        "aud" => "localhost",
        "data" => array(
            "id" => $id,
            "user_name" => $user_name,
            "pass" => $password
        )
    );
    $jwt = JWT::encode($payload, $key);
    //$answer = 'Успешно'."<br>";
    //header('Location: url_send.php');
    print_r($jwt);
}else {
    echo "Такого пользователя не существует";
}
