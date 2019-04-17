<?php

    $jsondata = file_get_contents("test.json");
    $json = json_decode($jsondata,true);
  

    echo $json['sitecode'][1]['id'];

?>
