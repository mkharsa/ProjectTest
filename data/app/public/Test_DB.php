<?php

//require_once '../backend/DBManager.php';
$db = mysqli_connect($_GET['server']/*.":".$_GET['port']*/, $_GET['user'], $_GET['pwd'],"greentecbda") ;

if (!$db) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}else{
	echo "Database connected!";
}


/*$db_manager = new DBManager();

$result = $db_manager->getSurveyList();

if($result!=null){
	echo "getSurveyQuestions Request:"."<br>";
	while($row = $result->fetch_assoc()) {
		echo "Survey Id: ".$row['SURVEYID']."<br>";
		echo "Survey Name: ".$row['SURVEYNAME']."<br>";
		echo "Survey Expiration date: ".$row['SURVEYEXPIRATION']."<br>";
		echo "Survey Creation date: ".$row['SURVEYDATECREATION']."<br>";
		echo "Survey Questions numbers: ".$row['question_numbers']."<br>";
		echo "===================================="."<br>";
		
	}
	echo "END Request"."<br>";
}else{
	echo "Result NULL"."<br>";
}*/


/*$result = $db_manager->getSurveyQuestions(1, 2);

if($result!=null){
	echo "getSurveyQuestions Request:"."<br>";
	while($row = $result->fetch_assoc()) {
		echo "Question Id: ".$row['QUESTIONID']."<br>";
		echo "Question Content: ".$row['QUESTIONCONTENT']."<br>";
		echo "Question Type: ".$row['QUESTIONTYPE']."<br>";
		echo "Question Required: ".$row['REQUIRED']."<br>";
		echo "Question Answer Id: ".$row['ANSWERID']."<br>";
		echo "Question Answer Content: ".$row['ANSWERCONTENT']."<br>";
		echo "===================================="."<br>";

	}
	echo "END Request"."<br>";
}else{
	echo "Result NULL"."<br>";
}*/


/*$result = $db_manager->insertUserSurvey(1, 1);
echo "Result of insertion: ".$result;*/

/*$result = $db_manager->insertNewAnswer(1, "hola");
echo "Result of insertion: ".$result;*/

/*$result = $db_manager->insertUserSubmittedAnswers("1","1","1");
echo "Result of insertion: ".$result;*/



?>