<?php
require_once(dirname(__FILE__)."/../Config.php");
require_once(FRAME_WORK_PATH."db/db_pgsql.php");
require_once("EmailSender.php");

class BetonEmailSender extends EmailSender{
	public static function addEMail(
			$link,
			$funcText,
			$attArray=NULL,
			$smsType=NULL
		){
		$ar = $link->query_first(sprintf(
		"SELECT * FROM %s AS (
			body text,
			email text,
			mes_subject text,
			name_from text,
			name_to text)",
		$funcText
		));
		
		$mail_id = NULL;
		if (is_array($ar)&&count($ar)){
			$mail_id = parent::addEMail(
				$link,
				EMAIL_FROM_ADDR,$ar['name_from'],
				$ar['email'],$ar['name_to'],
				EMAIL_FROM_ADDR,$ar['name_from'],
				EMAIL_FROM_ADDR,
				$ar['mes_subject'],
				$ar['body']	,
				$smsType			
			);
			if (is_array($attArray)){
				foreach ($attArray as $f){
					PPEmailSender::addAttachment($link,$mail_id,$f);
				}
			}
		}
		return $mail_id;
	}
	public static function sendAllMail($delFiles=TRUE){
		$dbLink = new DB_Sql();
		$dbLink->persistent=true;
		$dbLink->database	= DB_NAME;			
		$dbLink->connect(DB_SERVER_MASTER,DB_USER,DB_PASSWORD);
		
		parent::sendAllMail($dbLink,
				SMTP_HOST,SMTP_PORT,SMTP_USER,SMTP_PWD,
				$delFiles);
	}
	
}
?>
