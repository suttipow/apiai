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
  //      $arrayPostData['messages'][0]['type'] = "sticker";
  //      $arrayPostData['messages'][0]['packageId'] = "2";
  //      $arrayPostData['messages'][0]['stickerId'] = "46";
          $arrayPostData['messages'][0]['type'] = "template";
          $arrayPostData['messages'][0]['altText'] = "Carousel daftar berita";
              $arrayPostData['messages'][0]['template'] = "carousel";
          $arrayPostData['messages'][0]['thumbnailImageUrl'] = "https://live.staticflickr.com/65535/48941198207_425b166141_h.jpg";
        
        replyMsg($arrayHeader,$arrayPostData);
    }


    #ตัวอย่าง Message Type "Image"
    else if($message == "รูปน้องแมว"){
        $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }

    else if($message == "รูปapi"){
       // $image_url = "https://www.unzeen.com/wp-content/uploads/2017/03/OAuth2-flow.png";
        $image_url = "https://drive.google.com/uc?id=1OGjHEa5P2Res7ojeV3pm_vmLprgFMund";
   
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;

        replyMsg($arrayHeader,$arrayPostData);
    }

    #ตัวอย่าง Message Type "Location"
    else if($message == "พิกัดสยามพารากอน"){
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
    else if($message == "ลาก่อน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "131";
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
