<?php
$method = @$_SERVER['REQUEST_METHOD'];
$resource = @$_SERVER['REQUEST_URI'];
$finaData = array();
$busName = "";
switch ($method) {

    case 'GET':

	$query = parse_url($resource, PHP_URL_QUERY);

	if ( $query == "BusName") {
//		global $busName;
		echo "kjhfskqdjf";
	}
	
	break;
    case 'POST':
	$query = parse_url($resource, PHP_URL_QUERY);

	if ( $query == "newAJDevice" ) {
		$data = trim(file_get_contents('php://input'));
		$xml = simplexml_load_string($data);
		print_r($xml);
//		global $busName;
		$busName = $xml->BusName;
		echo $busName . "\n";
		echo "\nStatus : 200 OK";
	} elseif ( $query == "BusStatus" ) {
		$data = $_REQUEST;
		
		foreach ($data as $key => $value) {
			echo "Key: " . $key . " Value: " . $value . "\n";
		}
	} else {
		echo "\nStatus : Unknown Error";
	}
    	break;
    default:
        echo "Unsupported method ". $method . " requested.!\n";
        break;
}
?>
