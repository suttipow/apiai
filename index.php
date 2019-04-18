<?php

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);

  //  $text = $json->metadata->intentName->text;
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
            break;
        default:
            $speech = "Sorry, I didnt get that.";
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
