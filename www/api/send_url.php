<?php
require ('conn.php');

session_start();
$decoded = $_SESSION['decoded'];
$dc = (array) $decoded;
$user_id = (array) $dc['data'];
$user_id =$user_id['id'];

$url = $_POST['url'];
if ($url != ''){
    $date_time = date("Y-m-d H:i:s");
    $sql = "INSERT INTO url_tb(url, user_id, Date_time) VALUES(:url, :user_id, :Date_time)";
    $query = $pdo->prepare($sql);
    $query->execute(['url' => $url, 'user_id' => $user_id, 'Date_time' => $date_time]);     //отправка в бд
    echo "Данные отправлены";
} else {
    echo "Вставьте url";
}
