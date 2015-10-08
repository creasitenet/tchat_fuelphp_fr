<?php
class Controller_User extends Controller_Base {
   
    public function before() {
        parent::before(); 
    }
        
    public function after($response) {
        return parent::after($response);
    }
	
	public function action_login() {
		$val= Model_User::validate_tchat_login();
		if (Input::method() == 'POST') {
			if ($val->run()) {
				$e = Model_User::find('first', array(
				    'where' => array(array('username', Input::post('username')),array('email', Input::post('email')))
			    ));
				if(!$e) {
					$auth = Auth::instance();
					try {
						$auth->create_user(Input::post('username'), 'nopassword', Input::post('email'), 1);
						$e = Model_User::find('first', array(
						    'where' => array(array('username', Input::post('username')))
		            	));
						if ($e) {
							Auth::force_login($e->id);
							Session::set_flash('success_growl', e("Inscription enregistrée."));
						} else {
			        		Session::set_flash('error_growl', "Il y a un problème.");						
						}
					} catch (SimpleUserUpdateException $error) {
				        if($error='Username already exists') {
				        	Session::set_flash('error_growl', "Cet identifiant ou adresse email est déjà utilisé");
				        } else {
				        	Session::set_flash('error_growl', $error->getMessage());
				        }
				    }
					Response::redirect(Uri::Base());
				} else {
					Auth::force_login($e->id);
					Session::set_flash('success_growl', e("Connecté."));
					Response::redirect(Uri::Base());
				}
			} else {
				Session::set_flash('error_growl', $val->error());
				Response::redirect(Uri::Base());
			}
		}
		Response::redirect(Uri::Base());
	}

	public function action_logout() {
		Auth::logout();
		Session::set_flash('success_growl', e('Déconnecté.'));
		Response::redirect(Uri::Base());
	}
	
    // Refresh // Appel Ajax
    public function action_getAjaxRefresh() {    			
		$data['users'] =  Model_User::find('all', array(
       		'order_by' => array('created_at' => 'desc')
        ));  
		$d=View::forge('tchat/_users', $data);
		return $d;
    }	

}