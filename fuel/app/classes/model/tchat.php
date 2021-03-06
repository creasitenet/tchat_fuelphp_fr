<?php
class Model_Tchat extends \Orm\Model {
	
	protected static $_properties = array(
		'id',
		'user_id',
		'text',
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
		$val->add_field('text', 'Texte', 'required');
		return $val;
	}

	// Belongs to
	protected static $_belongs_to = array(
	    'user' => array(
	        'key_from' => 'user_id',
	        'model_to' => 'Model_User',
	        'key_to' => 'id',
	        'cascade_save' => false,
	        'cascade_delete' => false,
	    )
	);
	
	// Date de création
	public function creation_date() {
		return date('d-m-y à H:i:s', $this->created_at);
	}

	// Date de création
	public function short_creation_date() {
		return date('d-m-y', $this->created_at);
	}
	
}
