<?php
//======== start =======
$json_data = file_get_contents("test2.json");    
$php_data = json_decode($json_data,true);

    

//===== End ====
    
    $accessToken = "GrdyWWMyGn+VXUKHo9ndyocqkUWecuwSt+UEg9sGg4fJ8XzD1DB/JtZr9bAEvzBo8PdQqCW4TwMEhGWyT2dGc6gfWWcTH2oiZGAJIWwZCx9GnwlTEVmBWJdw7pdRcChdCCq0S0dIt1nekDN6mnIb4QdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];

    //===== start ===
    
    $message = preg_replace('/[[:space:]]+/', '', trim($message));

     for($x = 0; $x <= 2000; $x++)
     {
          if(strtoupper($message) == $php_data['user'][$x]['id'])
          {
          $speech = $php_data['user'][$x]['name'];
          $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
          $arrayPostData['messages'][0]['type'] = "text";
          $arrayPostData['messages'][0]['text'] = $speech;
          $arrayPostData['messages'][1]['type'] = "sticker";
          $arrayPostData['messages'][1]['packageId'] = "2";
          $arrayPostData['messages'][1]['stickerId'] = "34";
          replyMsg($arrayHeader,$arrayPostData);
          break;
          }
     }
        //===== stop ===

#ตัวอย่าง Message Type "Text"
    if($message == "สวัสดี"){     
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Sticker"
    else if($message == "ฝันดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "2";
        $arrayPostData['messages'][0]['stickerId'] = "46";
        replyMsg($arrayHeader,$arrayPostData);
    }
 
    #ตัวอย่าง Message Type "Image"  


    else if($message == "แนะนำ"){
        $image_url = "https://live.staticflickr.com/65535/49679364257_a60fde72d3_z.jpg";
        $image_url1 = "https://live.staticflickr.com/65535/49677854488_a6dabc4e57_b.jpg";

        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url1;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url1;

      
        $arrayPostData['messages'][1]['type'] = "image";
        $arrayPostData['messages'][1]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][1]['previewImageUrl'] = $image_url;  
        replyMsg($arrayHeader,$arrayPostData);
    }

    else if($message == "ผลงาน"){
       // $image_url = "https://www.unzeen.com/wp-content/uploads/2017/03/OAuth2-flow.png";
       // $image_url = "https://drive.google.com/uc?id=1OGjHEa5P2Res7ojeV3pm_vmLprgFMund";
        $image_url = "https://live.staticflickr.com/65535/49677854488_a6dabc4e57_b.jpg";

        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['id'] = "325708";
        $arrayPostData['messages'][0]['type'] = "video";
        $arrayPostData['messages'][0]['duration'] = 4000;
        $arrayPostData['messages'][0]['originalContentUrl'] = "https://apiai-chatbot-webhook555.herokuapp.com/svc1.mp4";
        $arrayPostData['messages'][0]['previewImageUrl'] = "https://live.staticflickr.com/31337/49678300113_67007bcda1_z.jpg";

        $arrayPostData['messages'][1]['type'] = "image";
        $arrayPostData['messages'][1]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][1]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if($message == "video"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken']; 
        $arrayPostData['messages'][0]['id'] = "325708";
        $arrayPostData['messages'][0]['type'] = "video";
        $arrayPostData['messages'][0]['duration'] = 4000;
        $arrayPostData['messages'][0]['originalContentUrl'] = "https://apiai-chatbot-webhook555.herokuapp.com/svc1.mp4";
        $arrayPostData['messages'][0]['previewImageUrl'] = "https://live.staticflickr.com/31337/49678300113_67007bcda1_z.jpg";

        replyMsg($arrayHeader,$arrayPostData);
    }

    #ตัวอย่าง Message Type "Location"
    else if($message == "พิกัด"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
        $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
        $arrayPostData['messages'][0]['latitude'] = "13.7465354";
        $arrayPostData['messages'][0]['longitude'] = "100.532752";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if($message == "พิกัดmarriott"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "JW Marriott";
        $arrayPostData['messages'][0]['address'] =   "13.7413525,100.5526719";
        $arrayPostData['messages'][0]['latitude'] = "13.7413525";
        $arrayPostData['messages'][0]['longitude'] = "100.5526719";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
    else if($message == "แจ้งซ่อม"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "081-956-2226";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "2";
        $arrayPostData['messages'][1]['stickerId'] = "502";
        replyMsg($arrayHeader,$arrayPostData);
    }
function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>
