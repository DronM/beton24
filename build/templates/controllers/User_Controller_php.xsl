<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_php.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'User'"/>
<!-- -->

<xsl:output method="text" indent="yes"
			doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" 
			doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>
			
<xsl:template match="/">
	<xsl:apply-templates select="metadata/controllers/controller[@id=$CONTROLLER_ID]"/>
</xsl:template>

<xsl:template match="controller"><![CDATA[<?php]]>
<xsl:call-template name="add_requirements"/>
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/GlobalFilter.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelWhereSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/ParamsSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelVars.php');

require_once('common/PwdGen.php');
require_once('common/SMSService.php');
require_once('functions/BetonEmailSender.php');

class <xsl:value-of select="@id"/>_Controller extends ControllerSQL{
	const PWD_LEN = 6;
	const ER_USER_NOT_DEFIND = "Пользователь не определен!@1";
	const ER_NO_EMAIL_TEL = "У пользователя нет ни телефона ни эл.почты!";
	
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);<xsl:apply-templates/>
	}
	
	public function insert($pm){
		$link = $this->getDbLink();
		$params = new ParamsSQL($pm,$link);
		$params->set('email',DT_STRING);
		$params->set('tel',DT_STRING);
		$params->set('pwd',DT_STRING);
	
		$email = $params->getVal('email');
		$tel = $params->getVal('tel');
	
		if (!strlen($email)&amp;&amp;!strlen($tel)){
			throw new Exception(User_Controller::ER_NO_EMAIL_TEL);
		}
		$new_pwd = gen_pwd(self::PWD_LEN);
		$pm->setParamValue('pwd',$new_pwd);
		
		//INSERT
		$model_id = $this->getInsertModelId();
		$model = new $model_id($this->getDbLinkMaster());
		$inserted_id_ar = $this->modelInsert($model,TRUE);
		
		$this->pwd_notify(
			$inserted_id_ar['id'],
			$new_pwd,
			$params->getDbVal('pwd'),
			$email,$tel);
	}
	
	<xsl:call-template name="extra_methods"/>
}
<![CDATA[?>]]>
</xsl:template>

<xsl:template name="extra_methods">
	
	private function setLogged($logged){
		if ($logged){			
			$_SESSION['LOGGED'] = true;			
		}
		else{
			session_destroy();
			$_SESSION = array();
		}		
	}
	private function getLogged(){
		return (isset($_SESSION["LOGGED"]) AND $_SESSION["LOGGED"]);
	}
	public function logout(){
		$this->setLogged(FALSE);
	}
	public function logout_html(){
		$this->logout();
		header("Location: index.php");
	}
	
	/* array with user inf*/
	private function set_logged($ar){
		$this->setLogged(TRUE);
		
		$_SESSION['user_id']		= $ar['id'];
		$_SESSION['user_name']		= $ar['name'];
		$_SESSION['role_id']		= $ar['role_id'];
		$_SESSION['role_descr'] 	= $ar['role_descr'];
		$_SESSION['user_time_locale'] 	= $ar['time_locale'];
		$_SESSION['hour_dif'] 		= $ar['hour_dif'];
		$_SESSION['tel_ext'] 		= $ar['tel_ext'];
		
		//global filters
		
		$log_ar = $this->getDbLinkMaster()->query_first(
			sprintf("SELECT pub_key FROM logins
			WHERE session_id='%s' AND user_id ='%s' AND date_time_out IS NULL",
			session_id(),$ar['id'])
		);
		if (!$log_ar['pub_key']){
			//no user login
			
			$this->pub_key = uniqid();
			
			$log_ar = $this->getDbLinkMaster()->query_first(
				sprintf("UPDATE logins SET 
					user_id = '%s',
					pub_key = '%s'
				WHERE session_id='%s' AND user_id IS NULL
				RETURNING id",
				$ar['id'],$this->pub_key,session_id())
			);				
			if (!$log_ar['id']){
				//нет вообще юзера
				$log_ar = $this->getDbLinkMaster()->query_first(
					sprintf("INSERT INTO logins
					(date_time_in,ip,session_id,pub_key,user_id)
					VALUES('%s','%s','%s','%s','%s')
					RETURNING id",
					date('Y-m-d H:i:s'),$_SERVER["REMOTE_ADDR"],
					session_id(),$this->pub_key,$ar['id'])
				);								
			}
			$_SESSION['LOGIN_ID'] = $ar['id'];			
		}
		else{
			//user logged
			$this->pub_key = trim($log_ar['pub_key']);
		}
	}
	
	public function do_login($pm){
		$link = $this->getDbLink();
		
		$name = NULL;
		$this->pwd = $pm->getParamValue('pwd');
		$pwd = NULL;
		
		FieldSQLString::formatForDb($link,
			$pm->getParamValue('name'),$name);
		FieldSQLString::formatForDb($link,
			$this->pwd,$pwd);
		
		$ar = $link->query_first(
			sprintf(
			"SELECT 
				u.name,
				u.role_id,
				u.id,
				get_role_types_descr(u.role_id) AS role_descr,
				u.tel_ext,
				tz.name AS time_locale,
				tz.hour_dif AS hour_dif
			FROM users AS u
			LEFT JOIN time_zone_locales AS tz ON tz.id=u.time_zone_locale_id
			WHERE u.name=%s AND u.pwd=md5(%s)",
			$name,$pwd));
			
		if ($ar){
			$this->set_logged($ar);
		}
		else{
			throw new Exception(ERR_AUTH);
		}
	}
	public function login($pm){
		//$this->do_login($pm);
		$this->login_ext($pm);
	}
	
	public function login_refresh($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
		$refresh_token = $p->getVal('refresh_token');
		$refresh_p = strpos($refresh_token,':');
		if ($refresh_p===FALSE){
			throw new Exception(ERR_AUTH);
		}
		$refresh_salt = substr($refresh_token,0,$refresh_p);
		$refresh_salt_db = NULL;
		$f = new FieldExtString('salt');
		FieldSQLString::formatForDb($this->getDbLink(),$f->validate($refresh_salt),$refresh_salt_db);
		
		$refresh_hash = substr($refresh_token,$refresh_p+1);
		
		$ar = $this->getDbLink()->query_first(
		"SELECT
			l.id,
			trim(l.session_id) session_id,
			u.pwd u_pwd_hash
		FROM logins l
		LEFT JOIN users u ON u.id=l.user_id
		WHERE l.date_time_out IS NULL
			AND l.pub_key=".$refresh_salt_db);
		
		if (!$ar['session_id']
		||$refresh_hash!=md5($refresh_salt.$_SESSION['user_id'].$ar['u_pwd_hash'])
		){
			throw new Exception(ERR_AUTH);
		}	
				
		$link = $this->getDbLinkMaster();
		
		try{
			//продляем сессию, обновляем id
			$old_sess_id = session_id();
			session_regenerate_id();
			$new_sess_id = session_id();
			$pub_key = uniqid();
			
			$link->query('BEGIN');									
			$link->query(sprintf(
			"UPDATE sessions
				SET id='%s'
			WHERE id='%s'",$new_sess_id,$old_sess_id));
			
			$link->query(sprintf(
			"UPDATE logins
				SET set_date_time=now()::timestamp,
					session_id='%s',
					pub_key='%s'
			WHERE id=%d",$new_sess_id,$pub_key,$ar['id']));
			
			$link->query('COMMIT');
		}
		catch(Exception $e){
			$link->query('ROLLBACK');
			$this->setLogged(FALSE);
			throw new Exception(ERR_AUTH);
		}
		
		//новые данные		
		$access_token = $pub_key.':'.md5($pub_key.$new_sess_id);
		$refresh_token = $pub_key.':'.md5($pub_key.$_SESSION['user_id'].$ar['u_pwd_hash']);
		
		$this->addModel(new ModelVars(
			array('name'=>'Vars',
				'id'=>'Auth_Model',
				'values'=>array(
					new Field('access_token',DT_STRING,
						array('value'=>$access_token)),
					new Field('refresh_token',DT_STRING,
						array('value'=>$refresh_token)),
					new Field('expires_in',DT_INT,
						array('value'=>SESSION_EXP_SEC)),
					new Field('time',DT_STRING,
						array('value'=>round(microtime(true) * 1000)))						
				)
			)
		));		
	}
	
	public function login_ext($pm){
		$this->do_login($pm);
		
		$access_token = $this->pub_key.':'.md5($this->pub_key.session_id());
		$refresh_token = $this->pub_key.':'.md5($this->pub_key.$_SESSION['user_id'].md5($this->pwd));
		
		$this->addModel(new ModelVars(
			array('name'=>'Vars',
				'id'=>'Auth_Model',
				'values'=>array(
					new Field('access_token',DT_STRING,
						array('value'=>$access_token)),
					new Field('refresh_token',DT_STRING,
						array('value'=>$refresh_token)),
					new Field('expires_in',DT_INT,
						array('value'=>SESSION_EXP_SEC)),
					new Field('time',DT_STRING,
						array('value'=>round(microtime(true) * 1000))),
					new Field('hour_dif',DT_INT,
						array('value'=>$_SESSION['hour_dif']))						
				)
			)
		));
		
		$this->addModel(new ModelVars(
			array('name'=>'Vars',
				'id'=>'User_Model',
				'values'=>array(
					new Field('id',DT_INT,
						array('value'=>$_SESSION['user_id'])),
					new Field('name',DT_STRING,
						array('value'=>$_SESSION['user_name'])),
					new Field('role_id',DT_INT,
						array('value'=>$_SESSION['role_id'])),
					new Field('role_descr',DT_INT,
						array('value'=>$_SESSION['role_descr'])),
					new Field('tel_ext',DT_INT,
						array('value'=>$_SESSION['tel_ext']))
					)
				)
			)
		);		
	}
	
	private function pwd_notify($userId,$pwd,$pwdDb,$email,$tel){
		if (strlen($email)){
			//email
			BetonEmailSender::addEMail(
				$this->getDbLinkMaster(),
				sprintf("email_user_reset_pwd(%d,%s)",
					$userId,
					$pwdDb
				),
				NULL,
				'reset_pwd'
			);
		}		
		if (strlen($tel)){
			//SMS
			$sms_service = new SMSService(SMS_LOGIN, SMS_PWD);
			$sms_service->send($tel,
				'Вам назначен новый пароль '.$pwd,
				SMS_SIGN,SMS_TEST);			
		}
	
	}
	private function update_pwd($userId,$pwd,$email,$tel){
		$pwd_db = NULL;
		FieldSQLString::formatForDb($this->getDbLink(),
			$pwd,
			$pwd_db);
	
		$this->pwd_notify($userId,$pwd,$pwd_db,$email,$tel);
		
		$this->getDbLinkMaster()->query(sprintf(
			"UPDATE users SET pwd=md5(%s)
			WHERE id=%d",
			$pwd_db,$userId)
		);
	}
	
	public function set_new_pwd($pm){
		$link = $this->getDbLink();
		
		$params = new ParamsSQL($pm,$link);
		$params->set('pwd',DT_STRING,array('required'=>TRUE));	
		
		$this->getDbLinkMaster()->query(sprintf(
			"UPDATE users SET pwd=md5(%s)
			WHERE id=%d",
			$params->getDbVal('pwd'),
			$_SESSION['user_id'])
		);
	}
	public function active_calls($pm){
		$this->addNewModel(sprintf(
		"SELECT * FROM ast_calls_active('%s')",
		$_SESSION['tel_ext']
		),'active_calls');
	}
	public function reset_pwd($pm){
		$link = $this->getDbLink();
		$params = new ParamsSQL($pm,$link);
		$params->set('user_id',DT_INT,array('required'=>TRUE));	
		
		$ar = $this->getDbLink()->query_first(sprintf(
		"SELECT email,phone_cel
		FROM users
		WHERE id=%d",
		$params->getParamById('user_id')
		));
		if (!is_array($ar)||!count($ar)){
			throw new Exception(User_Controller::ER_USER_NOT_DEFIND);
		}		
		if (!strlen($ar['email'])&amp;&amp;!strlen($ar['phone_cel'])){
			throw new Exception(User_Controller::ER_NO_EMAIL_TEL);
		}
		
		$this->update_pwd(
			$params->getParamById('user_id'),
			gen_pwd(self::PWD_LEN),
			$ar['email'],$ar['phone_cel']);
	}
	public function get_time($pm){
		$this->addModel(new ModelVars(
			array('name'=>'Vars',
				'id'=>'Time_Model',
				'values'=>array(
					new Field('value',DT_STRING,
						array('value'=>round(microtime(true) * 1000)))
					)
				)
			)
		);		
	}
</xsl:template>

</xsl:stylesheet>