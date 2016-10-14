<?php
echo "Login page";
if (isset ( $_GET ['username'] ) && $_GET ['username'] != '' && isset ($_GET ['pwd'])  && $_GET ['pwd'] != '') {

	$username = $_GET ['username'];
	$pwd =$_GET ['pwd'];
	echo "Test Login with ".$username." && ".$pwd;
}


?>