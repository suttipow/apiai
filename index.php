<?php

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);

    $json_data = file_get_contents("test.json");
    $php_data = json_decode($json_data);
    
  
//    echo $json['sitecode'][1]['id'];
    
    
    
  //  $text = $json->metadata->intentName->text;
  //  $text = $json->result->parameters->text;
     $text = $json->result->parameters->text;

    switch ($text) {
        case 'Name':
            $speech = "This question is too personal";
            break;
        case '555':
            $speech = "555 this ";
            break;
        case 'bye':
            $speech = "yes This question is too personal";
            //$speech = $php_data['sitecode'][1]['id']
            break;
        default:
            $speech = "Sorry, I didnt get that 888.";
            break;
    }

    $response = new \stdClass();
    $response->speech = $speech;
  //    $response->speech = "";
    $response->displayText = $speech;
  //  $response->displayText = "";
    $response->source = "webhook";
    echo json_encode($response);
}
else
{
    echo "Method not allowed";
}

?>
