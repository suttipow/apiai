<?php

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET'){
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);

    $text = $json->metadata->intentName->text;

    switch ($text) {
        case 'Name':
            $speech = "This question is too personal";
            break;

        default:
            $speech = "Sorry, I didnt get that.";
            break;
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
}

?>
