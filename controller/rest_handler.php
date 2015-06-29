<?php
$method = @$_SERVER['REQUEST_METHOD'];
$resource = @$_SERVER['REQUEST_URI'];
$finaData = array();
switch ($method) {

    case 'GET':
	$data = $_REQUEST;
	foreach ($data as $key => $value) {
		$finaData[$key] = $value;
		echo "$key => " . $finaData[$key] . " \n";
	}
	
	break;

    case 'POST':
	$query = parse_url($resource, PHP_URL_QUERY);

	if ( $query == "newAJDevice" ) {
		$data = trim(file_get_contents('php://input'));
		print_r($data);

		echo "\nstatus: 200 OK";
	} else {
		echo "\nstatus: 500 Internal server error";
	}
    	break;

    default:
        echo "Unsupported method ". $method . " requested.!\n";
        break;

}
?>
