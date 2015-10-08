<?php
return array(
	'_root_'  => 'tchat/index',  // The default route
	'_404_'   => 'errors/404',    // The main 404 route
	//'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	
     // Email
    'email' => 'email',
    'email/(:any)' => 'email/$1',
	
            
);
