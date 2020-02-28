<?php
require ('conn.php');
    
    
session_start();
$decoded = $_SESSION['decoded'];
$dc = (array) $decoded;
$user_id = (array) $dc['data'];
$user_id =$user_id['id'];
        
$arr =[];
    
$query = $pdo->query("SELECT * FROM `url_tb`");
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    array_push($arr, $row);
}
foreach ($arr as $result) {
    $ch = curl_init();
    $url = $result['url'];
                    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_NOBODY,true);
    curl_setopt($ch,CURLOPT_HEADER,true);
            
    $head = curl_exec($ch);
    if ($head) {
        $head_ar = explode(' ', $head);
        $time = curl_getinfo($ch);   
    }
    curl_close($ch);
    if ($result['user_id'] == $user_id) {
        $json_data = array (
            "id" => $result['id'],
            "url" => $url,
            "date_time" => $result['Date_time'],
            "http_code" => $head_ar[1],
            "time" => $time['total_time'],
        );
        echo json_encode($json_data);   
    }
}
