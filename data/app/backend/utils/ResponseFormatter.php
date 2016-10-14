<?php
 class ResponseFormatter {
 	
 	function __construct() {
 		require_once 'Constants.php';
 	}
 	
 	// destructor
 	function __destruct() {
 	}
 	
 	
 	public function formatSurveyListResponse($DBResult){
 		$outArray [Constants::SURVEY_LIST_PARAM_ARRAY] = array ();
 		
 		while($row = $DBResult->fetch_assoc()) {
 			$outArray [Constants::SURVEY_LIST_PARAM_ARRAY][]= array(
 				Constants::SURVEY_LIST_ID => $row['SURVEYID'],
 				Constants::SURVEY_LIST_NAME => $row['SURVEYNAME'],
 				Constants::SURVEY_LIST_EXPEIRATION_DATE => $row['SURVEYEXPIRATION'],
 				Constants::SURVEY_LIST_CREATION_DATE => $row['SURVEYDATECREATION'],
 				Constants::SURVEY_LIST_QUESTION_NUMBER => $row['question_numbers']		
 			);
 			
 		}
 		
 		return $outArray;
 		
 	}
 	
 	public function formatQuestionListResponse($DBResult){
 		$firstRow = $DBResult->fetch_assoc();
 		$outArray[Constants::QUESTION_ID]=$firstRow['QUESTIONID'];
 		$outArray[Constants::QUESTION_CONTENT]=$firstRow['QUESTIONCONTENT'];
 		$type =Constants::ANSWER_TYPES[$firstRow['QUESTIONTYPE']];
 		$outArray[Constants::QUESTION_TYPE]=$type;
 		$outArray[Constants::QUESTION_REQUIRED]=$firstRow['REQUIRED'];
 		
 		
 		if($type===Constants::LIST_QUESTION_TYPE || $type===Constants::SINGLE_CHOICE_QUESTION_TYPE || $type=== Constants::MULTIBLE_CHOICE_QUESTION_TYPE){
 			while($row = $DBResult->fetch_assoc()) {
 				$outArray [Constants::QUESTION_ANSWERS_ARRAY][]= array(
 						Constants::ANSWER_ID => $row['ANSWERID'],
 						Constants::ANSWER_CONTENT => $row['ANSWERCONTENT'],
 				);
 			
 			}
 		}
 		
 		return $outArray;
 	}
 	
 }

?>