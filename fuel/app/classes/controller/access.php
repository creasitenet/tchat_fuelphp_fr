<?php
class Controller_Access extends Controller_Base { 

	public function before() {
		parent::before();
    }

    public function after($response) { 
        return parent::after($response);
    }

	public function action_index() {
		Response::redirect(Uri::Base());
	}

	public function action_login() {
		$val= Model_User::validate_login();
		if (Input::method() == 'POST') {			
			if ($val->run()) {
				if ($this->auth->login(Input::post('username'), Input::post('password'))) {
					$user = Model_User::find_by_username($this->auth->get_screen_name());
					Session::set_flash('success', e('Bienvenue, '.$user->username));
					Response::redirect('/');
				} else {
					Session::set_flash('error', e('Identifiants incorrects'));
				}
			} else {
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->content = View::forge('access/login', array('val' => $val), false);
	}

	public function action_logout() {
		Auth::logout();
		Session::set_flash('success', e('Vous avez été déconnecté'));
		Response::redirect(Uri::Base());
	}

	public function action_lost_password() {
		$val= Model_User::validate_lost_password();
		if (Input::method() == 'POST') {
			if ($val->run()) {
				$e = Model_User::find('first', array(
					    'where' => array(
					        array('username', Input::post('username')),
					        'or' => array(
					            array('email', Input::post('username')),
					        ),
					    )
            	));
				if ($e) {
					try {
		            	$auth = Auth::instance();
		            	$newpassword = $auth->reset_password($e->username);
						Session::set_flash('success', "Mot de passe modifié et envoyé par email.");
						$request = Request::forge('email/new_password')->execute(array('id' => $e->id, 'newpassword' => $newpassword));
					} catch (SimpleUserUpdateException $erreur) {
						Session::set_flash('error', $erreur->getMessage());
		            }
		            Response::redirect('connexion');	           
				} else {
					Session::set_flash('error', e('Identifiant ou email inconnu'));
					$this->template->set_global('identifiant_ou_email_error', 'Cet identifiant ou email est inconnu.');
				}
			} else {
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->content = View::forge('access/lost_password', array('val' => $val), false);
	}
	
	// Inscription
	public function action_register() {
		$val = Model_User::validate_register();		
		if (Input::method() == 'POST') {
			if ($val->run()) {
				$auth = Auth::instance();
				try {
					$auth->create_user(Input::post('username'), Input::post('password'), Input::post('email'), 1);
					$e = Model_User::find('first', array(
						    'where' => array(array('username', Input::post('username')))
	            	));
					if ($e) {
						Session::set_flash('success', e("Inscription enregistrée."));
						Response::redirect('connexion');
					} else {
		        		Session::set_flash('error', "Il y a un problème.");						
					}
				} catch (SimpleUserUpdateException $erreur) {
		        	if($erreur='Username already exists') {
		        		Session::set_flash('error', "Cet identifiant ou adresse email est déjà utilisé");
		        	} else {
		        		Session::set_flash('error', $erreur->getMessage());
		        	}
		        }
			} else {
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->content = View::forge('access/register', array('val' => $val), false);
	}

}