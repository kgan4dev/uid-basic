<?php
$method = @$_SERVER['REQUEST_METHOD'];
$resource = @$_SERVER['REQUEST_URI'];

$createTable = "CREATE TABLE IF NOT EXISTS UIDTestTable (
AJSoftwareVersion VARCHAR(30) NOT NULL,
AppId VARCHAR(30) NOT NULL,
AppName VARCHAR(30) NOT NULL,
DateOfManufacture VARCHAR(30) NOT NULL,
DefaultLanguage VARCHAR(5) NOT NULL,
Description VARCHAR(100) NOT NULL,
DeviceId VARCHAR(30) NOT NULL,
DeviceName VARCHAR(30) NOT NULL,
HardwareVersion VARCHAR(30) NOT NULL,
Manufacturer VARCHAR(30) NOT NULL,
ModelNumber VARCHAR(30) NOT NULL,
SoftwareVersion VARCHAR(30) NOT NULL,
SupportUrl VARCHAR(30) NOT NULL,
SupportedLanguages VARCHAR(30) NOT NULL,
BusName VARCHAR(30) NOT NULL,
Status VARCHAR(30) NOT NULL)";


switch ($method) {
    case 'POST':
		$data = trim(file_get_contents('php://input'));

		$xml = simplexml_load_string($data);
		print_r($xml);

		$insertValues = "INSERT INTO UIDTestTable (AJSoftwareVersion, AppId, AppName, DateOfManufacture, DefaultLanguage, Description, DeviceId, DeviceName, HardwareVersion, Manufacturer, ModelNumber, SoftwareVersion, SupportUrl, SupportedLanguages, BusName, Status) VALUES ( '$xml->AJSoftwareVersion','$xml->AppId', '$xml->AppName', '$xml->DateOfManufacture', '$xml->DefaultLanguage', '$xml->Description', '$xml->DeviceId', '$xml->DeviceName', '$xml->HardwareVersion', '$xml->Manufacturer', '$xml->ModelNumber', '$xml->SoftwareVersion', '$xml->SupportUrl', '$xml->SupportedLanguages', '$xml->BusName', '$xml->Status' )";		

		$updateValues = "UPDATE UIDTestTable SET BusName='$xml->BusName',Status='$xml->Status' WHERE DeviceName='My device name'";

		$conn = new mysqli("localhost","root","vedams");

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$conn->query("CREATE DATABASE IF NOT EXISTS UIDTest");
		$conn->query("use UIDTest");
                $conn->query($createTable);
			
//		$conn->query($insertValues);

                $resp =  $conn->query("SELECT * FROM UIDTestTable WHERE DeviceName='$xml->DeviceName'");

                $row = mysqli_fetch_assoc($resp);
//                print_r($row);

                if ($row != "") {
                        /* Data exists , So update*/
		        if ($conn->query($updateValues) === TRUE) {
        	                echo "AJDevice info updated\n";
	                }

                } else {
                        /* Data not exists , So insert*/
	                if ($conn->query($insertValues) === TRUE) {
        	                echo "AJDevice info inserted\n";
                	}
                }

		$conn->close();

    		break;

    default:
	        echo "Unsupported method ". $method . " requested.!\n";
        	break;
}
?>
