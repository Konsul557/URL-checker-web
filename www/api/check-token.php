<?php
require ('../vendor/autoload.php');
use \Firebase\JWT\JWT;

use function PHPSTORM_META\type;

$secret_key = "localhost";
$jwt = null;
$data = $_COOKIE;
$key_no = array_search('', $data);

if ($key_no != "Такого_пользователя_не_существует" and $key_no != ''){
    $key = array_search('', $data);
    $arr = explode(':', $key);
    $str_cook = $arr[1];
    $pattern = '#_#';
    $replace = '#.#';
    $new_str_cook = preg_replace($pattern, $replace, $str_cook, 2);
    $new_str_cook = str_replace("#", "", $new_str_cook);
    $jwt = trim($new_str_cook, '\"\}');
    if ($jwt) {
        try {
            $decoded = JWT::decode($jwt, $secret_key, array('HS256'));
    
            // Access is granted. Add code of the operation here
    
            echo json_encode(array(
                "message" => "Access granted:",
                print_r($decoded)
            ));
            session_start();
            $_SESSION['decoded'] = $decoded;
            header("Location: ../url_send.php");
        } catch (Exception $e) {
            http_response_code(401);
    
            echo json_encode(array(
            "message" => "Access denied."
        ));
        }
    }
}else {
    echo "Такого пользователя не существует";
}