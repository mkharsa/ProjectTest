<?php

class Constants{
	//Answer Types
	const SINGLE_CHOICE_QUESTION_TYPE = "singleChoice";
	const MULTIBLE_CHOICE_QUESTION_TYPE = "multibleChoice";
	const TEXT_QUESTION_TYPE = "text";
	const NUMERIC_QUESTION_TYPE = "numeric";
	const LIST_QUESTION_TYPE = "list";
	
	const ANSWER_TYPES =array(self::SINGLE_CHOICE_QUESTION_TYPE,self::MULTIBLE_CHOICE_QUESTION_TYPE,self::TEXT_QUESTION_TYPE,self::NUMERIC_QUESTION_TYPE,self::LIST_QUESTION_TYPE);
	
	//Survey List Params
	const SURVEY_LIST_PARAM_ARRAY = "survey_list";
	const SURVEY_LIST_ID ="id";
	const SURVEY_LIST_NAME="name";
	const SURVEY_LIST_EXPEIRATION_DATE ="expriration_date";
	const SURVEY_LIST_CREATION_DATE ="creation_date";
	const SURVEY_LIST_QUESTION_NUMBER ="questions_number";
	
	//Survey question param
	const SURVEY_ID_PARAM = "survey_id";
	const QUESTION_NUM_PARAM = "question_num";
	
	//Rsponse
	const QUESTION_ID = "id";
	const QUESTION_CONTENT = "content";
	const QUESTION_TYPE ="type";
	const QUESTION_REQUIRED = "required";
	const QUESTION_ANSWERS_ARRAY="answers";
	const ANSWER_ID="answer_id";
	const ANSWER_CONTENT="answer_content";
	
	
	//Submit Survey Operation params
	const SUBMIT_SURVEY_ID_PARAM = "survey_id";
	const SUBMIT_ANSWER_PARAM_ARRAY="answer";
	const SUBMIT_QUESTUIN_ID_PARAM="question_id";
	const SUBMIT_ANSWER_ID_PARAM="answer_id";
	const SUBMIT_ANSWER_CONTENT_PARAM="answer_content";
}

?>