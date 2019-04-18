<?php

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);

    $json_data = file_get_contents("test.json");
    $php_data = json_decode($json_data);
    
  
//    echo $json['sitecode'][1]['id'];
    
    
    
     $text = $json->result->parameters->text;

    if($text == 'e001')
    {
    $speech = "This question is too personal";
    
    }
    else
    {
    $speech = "Noooooo This question is too personal";
    }    
//    switch ($text) {
//        case 'Name':
//            $speech = "This question is too personal";
//            break;
//        case '555':
//            $speech = "555 this ";
//            break;
//        case 'bye':
//            $speech = "yes This question is too personal";
//            break;
//        case 'hi5':
//            $speech = "Hi5 yes This question is too personal";
//            break;
//        default:
//            $speech = "Sorry, I didnt get that 888.";
//            break;
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
}

?>
