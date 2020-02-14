<?php

class Connect extends PDO
{
    public function cn() {
        $driver = "mysql";
        $host = "mariadb";
        $un = "root";
        $pass = "qwerty";
        $db_name = "urldb";
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ); 
        
        $pdo = new PDO("$driver:host=$host;dbname=$db_name", $un, $pass, $options);   //подключение к бд
    }
}

class Sign_up extends PDO
{
    public function q($pdo) {
        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "INSERT INTO users(user_name, email,password) VALUES(:user_name, :email,:password)";
        $query = $pdo->prepare($sql);
        $query->execute(['user_name' => $user_name, 'email' => $email,'password' => $password]);   //регистрация
    }
}

class url_db extends PDO
{
    public function url($pdo) {
        $url = $_POST['url'];
        $date_time = date("Y-m-d H:i:s");
        $sql = "INSERT INTO url_tb(url, Date_time) VALUES(:url, :date_time)";
        $query = $pdo->prepare($sql);
        $query->execute(['url' => $url, 'date_time' => $date_time]);     //отправка в бд
    }
}