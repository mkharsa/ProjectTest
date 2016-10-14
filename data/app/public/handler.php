<?php
if (isset ( $_GET ['op_id'] ) && $_GET ['op_id'] != '') {
	
	$operation_id = $_GET ['op_id'];
	if(isset($_GET['params'])){
		$params = $_GET['params'];
	}
	
	switch ($operation_id) {
		case 0 :
			//This is a test for response 
			echo file_get_contents("../backend/temp/web_api_simulation_response.json");
			break;
		case 1 :
			//This is a test of api call
			$_GET ['username']="Zak";
			$_GET ['pwd']="PWD";
			include '../backend/website/login.php';
			break;
		case 2 :
			echo "Operation 2";
			//...
			break;
	}
	
}

?>