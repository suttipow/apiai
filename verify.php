<?php
$access_token = 'GrdyWWMyGn+VXUKHo9ndyocqkUWecuwSt+UEg9sGg4fJ8XzD1DB/JtZr9bAEvzBo8PdQqCW4TwMEhGWyT2dGc6gfWWcTH2oiZGAJIWwZCx9GnwlTEVmBWJdw7pdRcChdCCq0S0dIt1nekDN6mnIb4QdB04t89/1O/w1cDnyilFU=';
$url = 'https://api.line.me/v1/oauth/verify';
$headers = array('Authorization: Bearer ' . $access_token);$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);curl_close($ch);echo $result;
?>
