<?php

$teste = array( "client" => array(
							    "build" => "1.0",
    							"name" => "xxxxxx",
    							"version" => "1.0"
 								),
 								"protocolVersion" => 4,
 				"data" => array(
    							"distributorId" => "xxxx",
    							"distributorPin" => "xxxx",
    							"locale" => "en-US"
 ));
echo json_encode($teste);


?>