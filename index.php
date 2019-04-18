<?php

$json_data = file_get_contents("test2.json");    
$php_data = json_decode($json_data,true);

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
  
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);
  
    //echo $json['sitecode'][1]['id'];
     $text = $json->result->parameters->text;
    
  for($x = 0; $x <= 2000; $x++)
  {

      if($text == $php_data['user'][$x]['id'])
      {
      $speech = $php_data['user'][$x]['name'];
      break;
      }
//      else
//      {
//      $speech = "Noooooo This question is too personal";
//      break;
//      }    
   }

    $response = new \stdClass();
    $response->speech = $speech;
    $response->displayText = $speech;
    $response->source = "webhook";
    echo json_encode($response);
}
else
{
    echo "Method not allowed";
    //echo $php_data['user'][0]['id'];
}

?>
