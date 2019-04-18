<?php

$json_data = file_get_contents("test.json");    
$php_data = json_decode($json_data,true);

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
  
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);
  
    //echo $json['sitecode'][1]['id'];
     $text = $json->result->parameters->text;
    
    foeeach($php_data['sitecode'] as $text)
    {
      
        $speech = $php_data['sitecode'][0]['id'];
      
    }

//    if($text == $php_data['sitecode'][0]['id'])
//    {
//    $speech = "e001 This question is too personal";
    
//    }
//    else
//    {
//    $speech = "Noooooo This question is too personal";
//    }    


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
