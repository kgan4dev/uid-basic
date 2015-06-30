<?php
$method = @$_SERVER['REQUEST_METHOD'];
$resource = @$_SERVER['REQUEST_URI'];
$splitData = array();
switch ($method) {

    case 'GET':
                $conn = new mysqli("localhost","root","vedams");

                if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                }

                $conn->query("use UIDTest");

                $resp =  $conn->query("SELECT * FROM UIDTestTable WHERE DeviceName='My device name'");

                $row = mysqli_fetch_assoc($resp);
//                print_r($row);

                echo $row['BusName'];	
		break;
    case 'POST':
		$data = $_REQUEST;
		
		foreach ( $data as $key => $value ) {
			$splitData[$key] = $value;
		}

		$status = $splitData['Status'];
//		print_r($splitData);
	
                $conn = new mysqli("localhost","root","vedams");

                if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                }

                $conn->query("use UIDTest");

                $resp =  $conn->query("UPDATE UIDTestTable SET Status='$status' WHERE DeviceName='My device name'");

                $row = mysqli_fetch_assoc($resp);
//                print_r($row);

    		break;
    default:
	        echo "Unsupported method ". $method . " requested.!\n";
        	break;
}
?>
