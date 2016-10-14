<?php
 
class DBManager {
 
    private $db;
    private $db_con;
    //put your code here
    // constructor
    function __construct() {
        require_once 'include/DB_CONNECT.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db_con = $this->db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }

    
    /*************** Return all survey list ***************/
    /**
     * Database methode for getSurveyList Operation
     */
    public function getSurveyList(){
    	//$result =$this->db_con->query("select * from source where id=2") or die(mysqli_error());
    	$result =$this->db_con->query("select SURVEY.SURVEYID ,SURVEY.SURVEYNAME ,SURVEY.SURVEYEXPIRATION ,SURVEY.SURVEYDATECREATION ,
 											  (select count(*) 
    										   from QUESTION
    										   where QUESTION.SURVEYID = SURVEY.SURVEYID) as question_numbers 
    								   from SURVEY") 
    							or die(mysqli_error());
    	$no_of_rows = mysqli_num_rows($result);
    	if ($no_of_rows > 0) {
    		//$result = mysqli_fetch_array($result);
    		return $result;
    	}else 
    		return null;
    }
	
    /**
     * Database methode for getSurveyQuestions operation
     * @param unknown $survey_id
     * @param unknown $question_num
     * @return unknown|NULL
     */
    public function getSurveyQuestions($survey_id,$question_num){
    	$result =$this->db_con->query("select QUESTION.QUESTIONID,QUESTION.QUESTIONCONTENT,QUESTION.QUESTIONTYPE,QUESTION.REQUIRED,ANSWER.ANSWERID,ANSWER.ANSWERCONTENT 
									   from QUESTION left join ANSWER on QUESTION.QUESTIONID=ANSWER.QUESTIONID 
									   where QUESTION.SURVEYID='$survey_id' and QUESTION.QUESTIONORDER='$question_num'") 
    							or die(mysqli_error());
    	$no_of_rows = mysqli_num_rows($result);
    	if ($no_of_rows > 0) {
    		//$result = mysqli_fetch_array($result);
    		return $result;
    	}else
    		return null;
    }
    
    /**
     * Database methode for submitSurvey operation
     * @param unknown $survey_id
     * @param unknown $survey_answers_array
     * @param unknown $userBBId
     */
    public function submitSurvey($survey_id,$survey_answers_array,$userBBId){
    	
    	//insert the User survey in the Table UserSurvey
    	$result_inset=$this->insertUserSurvey($survey_id, $userBBId);
    	
    	if($result_inset>=1){
    		
    		foreach ($survey_answers_array as $answer){
    			$question_id=$answer[Constants::SUBMIT_QUESTUIN_ID_PARAM];
    			//if the answer exist on the DB like List or Multiple,Single choice type
    			if(isset($answer[Constants::SUBMIT_ANSWER_ID_PARAM])){
    			
    				$answer_id = $answer[Constants::SUBMIT_ANSWER_ID_PARAM];
    				//insert in the table UserSubmittedAnswers
    				$this->insertUserSubmittedAnswers($question_id, $answer_id, $userBBId);
    				
    			}else{//if the answer not exist, it's custom answer from the user
    				
    				$answer_content=$answer[Constants::ANSWER_CONTENT];
    				//we insert this answer in the Answers Table and we get the Id because it's a custom answer from the user
    				$answer_new_id=$this->insertNewAnswer($question_id, $answer_content);
    				//after when we get the id we submite the answers in the table UserSubmittedAnswers
    				$this->insertUserSubmittedAnswers($question_id, $answer_new_id, $userBBId);
    				
    			};
    		}
    	}
    	
    }
    
    
    /**
     * Insert Survey in UserSurvey Table 
     * @param unknown $surveyId
     * @param unknown $userBBId
     * @return True or False
     */
    public function insertUserSurvey($surveyId,$userBBId){
    	$result =$this->db_con->query("INSERT INTO `USERSURVEY` (`USERBEBOUNDID`, `SURVEYID`, `SUBMISSIONDATE`) 
    															  VALUES ('$userBBId', '$surveyId', UNIX_TIMESTAMP())")
    			or die(mysqli_error());
    	return $result;
    }
    
    
    /**
     * Insert new answer for a question when Type is Text or Numeric
     * @param unknown $questionId
     * @param unknown $answerContent
     */
    public function insertNewAnswer($questionId,$answerContent){
    	$result =$this->db_con->query("INSERT INTO `ANSWER` (`QUESTIONID`, `ANSWERCONTENT`) VALUES ('$questionId', '$answerContent')");
    	return mysqli_insert_id($this->db_con);
    }
    
    /**
     * Insert new row in table UserSubmittedAnswers
     * @param unknown $questionId
     * @param unknown $answerId
     * @param unknown $userBBId
     */
    public function insertUserSubmittedAnswers($questionId,$answerId,$userBBId){
    	$result =$this->db_con->query("INSERT INTO `USERSUBMITTEDANSWERS` (`QUESTIONID`, `ANSWERID`, `USERBEBOUNDID`) 
    																VALUES ('$questionId', '$answerId', '$userBBId')")
    				or die(mysqli_error());
    	return $result;
    }
	
    
    /**
     * Methode that insert a temporary user for Testing the prototype
     * @param unknown $userBBId BeBound user phone id
     */
    public function createUserIfNotExists($userBBId){
    	
    	$result =$this->db_con->query("SELECT USERBEBOUNDID FROM greentecbda.USER where USERBEBOUNDID='$userBBId'")
    	    								   or die(mysqli_error());
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {
    	  //User exists do nothing
    	 }else{
    	 	//if the User with the id $userBBId donsn't exist we insert it
    	 	$userName = "PrototypeUser_".$userBBId;
    	 	$result =$this->db_con->query("INSERT INTO `USER` (`USERBEBOUNDID`, `USENAME`, `USERPHONENUMBER`, `USERCOUNTRY`, `USERCITY`, `USERCARRIER`, `USERGENDER`) VALUES ('$userBBId', '$userName', '213557430690', 'France', 'Paris', 'Engineer', '1');
    	 			")
    	 			or die(mysqli_error());
    	}
    }
	
 
}
 
?>