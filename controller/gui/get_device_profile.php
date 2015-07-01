<?php
$method = @$_SERVER['REQUEST_METHOD'];
$resource = @$_SERVER['REQUEST_URI'];

switch ($method) {
    case 'POST':
		$data = $_REQUEST;

		$device = $data['DeviceName'];

	        $conn = new mysqli("localhost","root","vedams");

                if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                }

                $conn->query("use UIDTest");

		/* If no device mentioned, return all the devices */
		if ( $device == "") {
                        $resp =  $conn->query("SELECT * FROM UIDTestTable");

			for ($i=0; $row = mysqli_fetch_assoc($resp); $i++) {
				$finalData[$i] = $row;
			}

//			print_r($finalData);

			header('Content-Type: application/json');	
			echo json_encode($finalData);
		} else {
	                $resp =  $conn->query("SELECT * FROM UIDTestTable WHERE DeviceName='$device'");

        	        $row = mysqli_fetch_assoc($resp);

			header('Content-Type: application/json');
			echo json_encode($row);

        	        if ($row == "") {
                	        /* Data not exists */
                        	echo "Device record not found\n";
	                }
		}

                $conn->close();

                break;

    default:
                echo "Unsupported method ". $method . " requested.!\n";
                break;
}
?>
