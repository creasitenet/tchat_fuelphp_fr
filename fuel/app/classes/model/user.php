<?php
class Model_User extends \Orm\Model {

	protected static $_properties = array(
		'id',
		'username',
		'password',
		'group',
		'email',
		'last_login',
		'login_hash',
		'profile_fields',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory) {
		$val = Validation::forge($factory);
		$val->add_field('username', 'Identifiant', 'required|min_length[5]|max_length[50]');
		$val->add_field('password', 'Mot de passe', 'required|min_length[5]|max_length[20]');
		$val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
		return $val;
	}

	public static function validate_tchat_login()	{
		$val = Validation::forge('login');
		// Regles de validation
		$val->add_field('username', 'Identifiant ou Email', 'required|min_length[5]|max_length[255]');
		$val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
		return $val;
	}

	public static function validate_login()	{
		$val = Validation::forge('login');
		// Regles de validation
		$val->add_field('username', 'Identifiant ou Email', 'required|min_length[5]|max_length[255]');
		$val->add_field('password', 'Mot de passe', 'required|min_length[5]|max_length[20]'); 
		return $val;
	}

	public static function validate_lost_password() {
		$val = Validation::forge('lost_password');
		$val->add_field('username', 'Identifiant ou Email', 'required|min_length[5]|max_length[255]');
		return $val;
	}

	public static function validate_register() {
		$val = Validation::forge('register');
		$val->add_callable('MyValidationRules');
		$val->add_field('username', 'Identifiant', 'required|min_length[5]|max_length[20]|trim|strip_tags')
			->add_rule('unique', 'users.username');
		$val->add_field('password', 'Mot de passe', 'required|min_length[5]|max_length[20]|trim|strip_tags'); 
		$val->add_field('email', 'Email', 'required|valid_email|max_length[255]')
			->add_rule('unique', 'users.email');
		return $val;
	}

	// Admin Modifier // Juste le mail et le role (admin ou user)
	public static function validate_edit() {
		$val = Validation::forge();
		// Regles de validation
		$val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
		return $val;
	}

	// has many posts
	protected static $_has_many = array( 
	    'tchat_messages' => array(
	        'key_from' => 'id',
	        'model_to' => 'Model_Tchat',
	        'key_to' => 'user_id',
	        'cascade_save' => false,
	        'cascade_delete' => false,
	    ),
	);
	
	// Gravatar
	public function gravatar() {
		$hash = md5(strtolower(trim($this->email)));
		return "http://www.gravatar.com/avatar/".$hash;
	}
	
	// Online
	public function is_online() {
        $timestamp20min = time()-1200;	// timestamp il y a 20 minutes
        if($this->last_login > $timestamp20min) { // L'utilisateur a été actif dans les 20 dernières minutes
        	return true;
 		} else { // L'utilisateur n'a été actif dans les 20 dernières minutes
 			return false;
        }
	}
	
	// Online img
	public function is_online_img() {
		$timestamp20min = time()-1200; 	// timestamp il y a 20 minutes
        if($this->last_login > $timestamp20min) {     	// L'utilisateur a été actif dans les 20 dernières minutes
        	return Asset::img('online.png', array('width'=>'10px', 'alt'=>'En ligne'));
 		} else {  	// L'utilisateur n'a été actif dans les 20 dernières minutes
 			return Asset::img('offline.png', array('width'=>'10px', 'alt'=>'Hors ligne'));
        }		
	}
	
}
