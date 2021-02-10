<?php 

namespace App\Controllers;

use System\Controller;

/**
* Controller HomeController
*
* @author Júlio César Cabral Valente
*/
class HomeController extends Controller
{
	public function index()
	{	
		$loginModel = $this->load->model('Login');
		
		if ($loginModel->isLogged())
		{
			 return $this->url->redirectTo('/dashboard');
		}
		
		$data['title'] = 'Login';
		return $this->view->render('login', $data);
	}

}
