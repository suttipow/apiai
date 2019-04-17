<?php

error_reporting(0);

date_default_timezone_set("Asia/Bangkok");

$date = date("Y-m-d");

$time = date("H:i:s");

$json = file_get_contents('php://input');

$request = json_decode($json, true);

$queryText = $request["queryResult"]["queryText"];

$action = $request["queryResult"]["action"];



$userId = $request['originalDetectIntentRequest']['payload']['data']['source']['userId'];





$myfile = fopen("log$date.txt", "a") or die("Unable to open file!");

$log = $date."-".$time."\t".$userId."\t".$queryText."\n".$c."\n";

fwrite($myfile,$log);

fclose($myfile);



$input = fopen("log_json.txt", "w") or die("Unable to open file!");

fwrite($input,$json);

fclose($input);



 



switch ($action) {



case "input.unknown": //input.unknown



$name = $_REQUEST['name'];



date_default_timezone_set("Asia/Bangkok");



$serverName = "host";



$userName = "username";



$userPassword = "password";



$dbName = "database";



$connect = mysqli_connect($serverName, $userName, $userPassword, $dbName) or die("connect error" . mysqli_error());



mysqli_set_charset($connect, "utf8");

$query = "SELECT name,content,year,img,url from library where name  LIKE '%" . $queryText . "%' ";



$resource = mysqli_query($connect, $query) or die("error" . mysqli_error());



$count_row = mysqli_num_rows($resource);



if ($count_row > 0) {

while ($result = mysqli_fetch_array($resource)) {

$img = $result['img'];

$name = $result['name'];

$year = $result['year'];

$content = $result['content'];

$url = $result['url'];



$curl = curl_init();



curl_setopt_array($curl, array(

CURLOPT_URL => "https://api.line.me/v2/bot/message/push",

CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,

CURLOPT_ENCODING => "",

CURLOPT_MAXREDIRS => 10,

CURLOPT_TIMEOUT => 30,

CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

CURLOPT_CUSTOMREQUEST => "POST",

CURLOPT_POSTFIELDS => "{\r\n\r\n    \"to\": \"$userId\",\r\n\r\n   \"messages\": [\r\n   \t{\r\n  \"type\": \"flex\",\r\n  \"altText\": \"ผลลัพธ์การค้นหา\",\r\n  \"contents\": \r\n  {\r\n  \"type\": \"bubble\",\r\n  \"styles\": {\r\n    \"footer\": {\r\n      \"backgroundColor\": \"#42b3f4\"\r\n    }\r\n  },\r\n  \"header\": {\r\n    \"type\": \"box\",\r\n    \"layout\": \"horizontal\",\r\n    \"contents\": [\r\n      {\r\n        \"type\": \"box\",\r\n        \"layout\": \"baseline\",\r\n        \"contents\": [\r\n          {\r\n            \"type\": \"icon\",\r\n            \"size\": \"xxl\",\r\n            \"url\": \"https://modcumram.com/img_lirt/lirt_logo.jpg\"\r\n          }\r\n        ]\r\n      },\r\n      {\r\n        \"type\": \"box\",\r\n        \"layout\": \"vertical\",\r\n        \"flex\": 5,\r\n        \"contents\": [\r\n          {\r\n            \"type\": \"text\",\r\n            \"text\": \"คลังสารสนเทศของสถาบันนิติบัญญัติ\",\r\n            \"weight\": \"bold\",\r\n            \"color\": \"#aaaaaa\",\r\n            \"size\": \"xs\",\r\n            \"gravity\": \"top\"\r\n          }\r\n        ]\r\n      }\r\n    ]\r\n  },\r\n  \"hero\": {\r\n    \"type\": \"image\",\r\n    \"url\": \"$img\",\r\n    \"size\": \"full\",\r\n    \"aspectRatio\": \"1:1\",\r\n    \"aspectMode\": \"fit\",\r\n    \"action\": {\r\n      \"type\": \"uri\",\r\n      \"uri\": \"$img\"\r\n    }\r\n  },\r\n  \"body\": {\r\n    \"type\": \"box\",\r\n    \"layout\": \"vertical\",\r\n    \"contents\": [\r\n      \r\n      {\r\n        \"type\": \"box\",\r\n        \"layout\": \"vertical\",\r\n        \"margin\": \"xs\",\r\n        \"contents\": [\r\n          {\r\n            \"type\": \"box\",\r\n            \"layout\": \"baseline\",\r\n            \"spacing\": \"sm\",\r\n            \"contents\": [\r\n              {\r\n                \"type\": \"text\",\r\n                \"text\": \"ชื่อเรื่อง   $name\",\r\n                \"wrap\": true,\r\n                \"color\": \"#666666\",\r\n                \"size\": \"sm\",\r\n                \"flex\": 6\r\n              }\r\n            ]\r\n          },\r\n          {\r\n            \"type\": \"box\",\r\n            \"layout\": \"baseline\",\r\n            \"spacing\": \"sm\",\r\n            \"contents\": [\r\n              {\r\n                \"type\": \"text\",\r\n                \"text\": \"ผู้แต่ง $content\",\r\n                \"wrap\": true,\r\n                \"color\": \"#666666\",\r\n                \"size\": \"sm\",\r\n                \"flex\": 6\r\n              }\r\n            ]\r\n          },\r\n          {\r\n            \"type\": \"box\",\r\n            \"layout\": \"baseline\",\r\n            \"spacing\": \"sm\",\r\n            \"contents\": [\r\n              {\r\n                \"type\": \"text\",\r\n                \"text\": \"ปีพิมพ์  $year\",\r\n                \"wrap\": true,\r\n                \"color\": \"#666666\",\r\n                \"size\": \"sm\",\r\n                \"flex\": 6\r\n              }\r\n            ]\r\n          }\r\n        ]\r\n      }\r\n    ]\r\n  },\r\n  \"footer\": {\r\n    \"type\": \"box\",\r\n    \"layout\": \"vertical\",\r\n    \"spacing\": \"sm\",\r\n    \"contents\": [\r\n      {\r\n        \"type\": \"button\",\r\n        \"style\": \"link\",\r\n        \"color\": \"#FFFFFF\",\r\n        \"height\": \"sm\",\r\n        \"action\": {\r\n          \"type\": \"uri\",\r\n          \"label\": \"อ่านต่อ\",\r\n          \"uri\": \"$url\"\r\n        }\r\n      }\r\n    ]\r\n  }\r\n}\r\n  \r\n}\r\n ]\r\n}\r\n",

CURLOPT_HTTPHEADER => array(

"authorization: Bearer line_token",

"cache-control: no-cache",

"content-type: application/json",

"postman-token: 6012e785-fb56-1a12-a2c5-e485ce2b2eab",

),

));



$response = curl_exec($curl);

$err = curl_error($curl);



curl_close($curl);



if ($err) {

echo "cURL Error #:" . $err;

} else {

echo $response;

}



}

} else {


//    echo " ";

}



break;



default:



$curl = curl_init();

curl_setopt_array($curl, array(

CURLOPT_URL => "https://api.line.me/v2/bot/message/push",

CURLOPT_SSL_VERIFYPEER => false,

CURLOPT_RETURNTRANSFER => true,

CURLOPT_ENCODING => "",

CURLOPT_MAXREDIRS => 10,

CURLOPT_TIMEOUT => 30,

CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

CURLOPT_CUSTOMREQUEST => "POST",

CURLOPT_POSTFIELDS => "{\r\n\r\n    \"to\": \"$userId\",\r\n\r\n   \"messages\": [{\r\n\r\n  \"type\": \"text\",\r\n\r\n    \"text\": \"รอก่อนน่ะครับ เรายังไม่มีข้อมูล\"\r\n\r\n    }]\r\n\r\n}",

CURLOPT_HTTPHEADER => array(

"authorization: Bearer line_token",

"cache-control: no-cache",

"content-type: application/json",

"postman-token: 7f766920-b207-53c4-6059-6d20ceec77ea",

),

));



$response = curl_exec($curl);

$err = curl_error($curl);



curl_close($curl);



}

?>
