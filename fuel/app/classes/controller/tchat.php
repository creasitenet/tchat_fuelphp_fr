<?php
class Controller_Tchat extends Controller_Base {
   
    public function before() {
        parent::before(); 
    }
        
    public function after($response) {
        return parent::after($response);
    }

    // Accueil
    public function action_index() {  
        $data['messages'] = Model_Tchat::find('all', array(
       		'order_by' => array('created_at' => 'desc')
        ));    			
		$data['users'] =  Model_User::find('all', array(
       		'order_by' => array('created_at' => 'desc')
        ));  
		$data['val'] = Model_User::validate_tchat_login(); 
        $this->template->content = View::forge('tchat/index', $data);
    }

	// Ajouter un message // Appel Ajax
	public function action_postAjaxAdd() {
    	$d['result']= 0;		
		if (Input::method() == 'POST') {
        	if (!$this->auth->check()) {   // pas identifié
				$d['message'] = "Vous devez écrire quelque chose pour participer.";
           	} else {
	            $text = $_POST['value'];
	            if ($text=='') {
	            	$d['message'] = "Votre commentaire ne peut pas être vide.";
	            } else {     
	               $e = Model_Tchat::forge(array(
	                    'user_id' => $this->auth->get('id'),
	                    'text' => $text,
	                    //'status' => '0',
	                ));
	                if ($e and $e->save()) {
						$d['result'] = 1;
						$d['message'] = "";
						// Pour le refresh
						$d['url'] = 'tchat/getAjaxRefresh';
			            $d['data'] = '';
						$d['div'] = '#tchat_messages';
	                } else {
	                    $d['message'] =  "Impossible d'ajouter le commentaire.";
	                }
	            }
	       	}
		}
        // header('Content-Type: application/json');
        return json_encode($d);
	}
	
    // Refresh Liste des messages // Appel Ajax
    public function action_getAjaxRefresh() {    	
		$data['messages'] =  Model_Tchat::find('all', array(
       		'order_by' => array('created_at' => 'desc')
        ));  
		$d=View::forge('tchat/_messages', $data);
		return $d;
    }
	
	public function action_getAjaxRefreshOne() {
		$id=Input::get('value');  	
		$data['m'] =  Model_Tchat::find($id);  
		$d=View::forge('tchat/_message', $data);
		return $d;
    }
   		
	// Pour l'admin
	// Utilisateur avec role = 100
	public function action_postAjaxDelete($id) {
		$d=array();
        if (Input::method() == 'POST') {
            $id = $_POST['value'];
            if ($e = Model_Tchat::find($id)) {
                $d['result'] =  1;
                $d['message'] =  "Le message a été supprimé.";
                $e->delete();
            } else {
                $d['result'] =  0;
                $d['message'] = "Impossible de supprimer le message.";
            }
        } 
        return json_encode($d);
	}
	

}