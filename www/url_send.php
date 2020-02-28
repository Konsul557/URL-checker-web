<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SEND</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <form action="api/send_url.php" method="POST" name="send">
            <div>
                <input type="text" name="url" id="url" placeholder="Вставьте url">
            </div>
            <div>
                <button id="button-send" class="button-send">SEND</button>
            </div>
        </form>
    </div>
    <script src="js/send.js"></script>

    <?php

    require ('api/conn.php');
    
    
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
    ?>
        <table border="1px" id="tb-result" class="tb-result">
            <tr>
                <th>ID</th>
                <th>URL</th>
                <th>Date time</th>
                <th>HTTP code</th>
                <th>Total time</th>
                <th id="th-status">STATUS</th>
            </tr>
        <?php foreach ($arr as $result) {
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
                ?>
                <tr>
                    <td><?print_r($result['id'])?> </td>
                    <td><?print_r($result['url']) ?> </td>
                    <td><?print_r($result['Date_time']) ?></td>
                    <td><?print_r($head_ar[1]) ?></td>
                    <td><?print_r($time['total_time']) ?></td>
                </tr>
            <?php } ?>   
            <?php } ?>  
        </table>
        <script src="js/check.js"></script>
</body>
</html>