<?php

$ch = curl_init();
$url = 'https://github.com/Konsul557';


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

?>