<?php
$iam = pathinfo ( $_SERVER ['SCRIPT_FILENAME'], PATHINFO_FILENAME );
ini_set ( 'error_log', '/var/log/php/php_log.' . $iam );

define ( 'BB_OK', 0 ); // OK
class bbCore {
	function __construct() { // check authorization first
		$auth = isset ( $_SERVER ['HTTP_AUTHORIZATION'] ) ? $_SERVER ['HTTP_AUTHORIZATION'] : '';
		if ($auth != '') {
			$this->error_log ( "authorization failed: auth:$auth--" );
			$this->sendResponse ( 'BB_ERROR_AUTHORIZATION' );
			exit (); // ********************************************************************
		}
		// get json post
		$request = json_decode ( file_get_contents ( "php://input" ), true );
		error_log ( "request: " . print_r ( $request, 1 ) . "--" );
		// determine all required parameters
		$this->moduleName = isset ( $request ['moduleName'] ) ? $request ['moduleName'] : '';
		$this->moduleId = isset ( $request ['moduleId'] ) ? $request ['moduleId'] : 0;
		$this->moduleVersion = isset ( $request ['moduleVersion'] ) ? $request ['moduleVersion'] : 0;
		$this->transport = isset ( $request ['transport'] ) ? $request ['transport'] : '';
		$this->userId = isset ( $request ['userId'] ) ? $request ['userId'] : 0;
		$this->phoneNumber = isset ( $request ['phoneNumber'] ) ? $request ['phoneNumber'] : '';
		$this->operation = isset ( $request ['operation'] ) ? $request ['operation'] : '';
		$this->inParams = isset ( $request ['params'] ) ? $request ['params'] : array ();
		$this->error_log ( "Request:" . print_r ( $request, 1 ) . "--" );
	}
	function sendResponse($ret, $outParams) {
		$response = $ret === BB_OK ? json_encode ( array (
				'params' => $outParams 
		) ) : json_encode ( array (
				'error' => $ret 
		) );
		header ( "Cache-control: private" );
		header ( "Pragma: " );
		header ( "Expires: " );
		header ( "Content-type: application/json; charset=UTF-8" );
		header ( "Content-Length: " . strlen ( $response ) );
		echo $response;
	}
	function error_log($s) {
		error_log ( $s );
	}
} // end class bbCore
class n4b_api extends \bbCore {
	
	private $db_manager;
	private $response_formatter;
	function __construct() {
		parent::__construct (); // don't change this
		require_once '../backend/DBManager.php';
		require_once '../backend/utils/ResponseFormatter.php';
		require_once '../backend/utils/Constants.php';
		$this->db_manager = new DBManager();
		$this->response_formatter = new ResponseFormatter();
	}
	
	/**
	 * Get All Survey list
	 */
	function getSurveyList($inArray, &$outArray) {
		//check and create user if dosn't exist
		$this->db_manager->createUserIfNotExists($this->userId);
		
		$surveyList = $this->db_manager->getSurveyList();
		if($surveyList!=null){
				$outArray = $this->response_formatter->formatSurveyListResponse($surveyList);
		}

		return BB_OK;
	}
	
	/**
	 * Get questions of a survey
	 */
	function getSurveyQuestions($inArray, &$outArray) {
		//check and create user if dosn't exist
		$this->db_manager->createUserIfNotExists($this->userId);
		
		if(isset($inArray[Constants::QUESTION_NUM_PARAM]) && isset($inArray[Constants::SURVEY_ID_PARAM])){
			$questionList = $this->db_manager->getSurveyQuestions($inArray[Constants::SURVEY_ID_PARAM], $inArray[Constants::QUESTION_NUM_PARAM]);
			if($questionList!=null){
				$outArray = $this->response_formatter->formatQuestionListResponse($questionList);
			}
		}
		return BB_OK;
	}
	
	/**
	 * Submit survey
	 */
	function submitSurvey($inArray, &$outArray) {
		//check and create user if dosn't exist
		$this->db_manager->createUserIfNotExists($this->userId);
		
		if(isset($inArray[Constants::SUBMIT_SURVEY_ID_PARAM]) && isset($inArray[Constants::SUBMIT_ANSWER_PARAM_ARRAY])){
			$survey_Id = $inArray[Constants::SUBMIT_SURVEY_ID_PARAM];
			$answers_array = $inArray[Constants::SUBMIT_ANSWER_PARAM_ARRAY];
			$this->db_manager->submitSurvey($survey_Id, $answers_array, $this->userId);
			//echo $this->userId;
		}
		return BB_OK;
	}
	
	// Errors:
} // end class
  
// *************************************** main part ************************************************************
$api = new n4b_api ();
$ret = $api->{$api->operation} ( $api->inParams, $outParams );
$api->sendResponse ( $ret, $outParams );

?>