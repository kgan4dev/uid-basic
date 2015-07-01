<?php
$method = @$_SERVER['REQUEST_METHOD'];
$resource = @$_SERVER['REQUEST_URI'];
$splitData = Array();

switch ($method) {
    case 'POST':
		$data = $_REQUEST;
		
		foreach ($data as $key => $value) {
			$splitData[$key] = $value;
		}		

		$device = $splitData['DeviceName'];

                $conn = new mysqli("localhost","root","vedams");

                if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                }

                $conn->query("use UIDTest");

                $resp =  $conn->query("SELECT * FROM UIDTestTable WHERE DeviceName='$device'");

                $row = mysqli_fetch_assoc($resp);

		header('Content-Type: application/json');
		echo json_encode($row);

                if ($row == "") {
                        /* Data not exists */
                        echo "Device record not found\n";
                }

                $conn->close();

                break;

    default:
                echo "Unsupported method ". $method . " requested.!\n";
                break;
}
?>
