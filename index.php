<?php

$json_data = file_get_contents("test.json");    
$php_data = json_decode($json_data,true);

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
  
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);
  
    //echo $json['sitecode'][1]['id'];
     $text = $json->result->parameters->text;
    
  for($x = 0; $x <= 10; $x++)
  {

      if($text == $php_data['sitecode'][$x]['id'])
      {
      $speech = "====555  hello world====";
      break;
      }
      else
      {
      $speech = "Noooooo This question is too personal";
      break;
      }    
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
    echo $php_data['sitecode'][0]['id'];
}

?>
