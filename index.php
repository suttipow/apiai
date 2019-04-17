<?php
  $method = $_SERVER['REQUEST_METHOD'];
  if($method == "POST"){
    $jsondata = file_get_contents("test.json");
    $json = json_decode($jsondata,true);
  
    $text = $json->result->parameters->text;
    foreach($json['sitecode'] as $sitecode){
      if($text == $sitecode['id']{
        echo $text;
      }
    
    }
    $response = new \stdClass();
    $response->speech ="";
    $response->displayText = "";
    $response->source = "webhook";
    echo $json['sitecode'][0]['id'];
  //  echo json_decode($response);
}  
else
{
    echo "Method npt allowed";
}
?>
