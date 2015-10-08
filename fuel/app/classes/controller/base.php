<?php
class Controller_Base extends Controller_Template {

    public $template = 'template';

	public function before(){		
		parent::before();  

        // Title
        $this->title = "Tchat ";
		
		// Auth
        $this->auth = Auth::instance();
        $user = $this->auth->check() ? Model_User::find_by_username($this->auth->get_screen_name()) : null;
        View::set_global('user', $user); 

        // Datas
        $this->data = array();
	}

    public function after($response) {
        // Title 
        $this->template->title = $this->title;
        // Response [OBLIGATOIRE]
        return parent::after($response);
    }

}