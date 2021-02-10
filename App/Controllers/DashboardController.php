<?php 

namespace App\Controllers;

use System\Controller;

/**
* Controller DashboardController
*
* @author Júlio César Cabral Valente
*/
class DashboardController extends Controller
{
	public function index()
	{
		$loginModel = $this->load->model('Login');
		
		if (!$loginModel->isLogged())
		{
			 return $this->url->redirectTo('/login');
		}
		
		$this->html->setTitle('Dashboard');
		$view = $this->view->render('dashboard');

		return $this->Layout->render($view);  
	}
}
