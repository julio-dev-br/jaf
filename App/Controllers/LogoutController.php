<?php 

namespace App\Controllers;

use System\Controller;

/**
* Controller LogoutController
*
* @author Júlio César Cabral Valente
*/
class LogoutController extends Controller
{
	/**
	* Logout do usuário
	*
	* @return mixed
	*/
	public function index() {
		$this->session->destroy();
		$this->cookie->destroy();
		
		$data['title'] = 'Login';
		return $this->url->redirectTo('/login', $data);
	}
}