<?php 

namespace App\Controllers\Partials;

use System\Controller;

/**
* Controller HomeController
*
* @author Júlio César Cabral Valente
*/
class HeaderController extends Controller
{
	public function index()
	{
		$data['title'] = $this->html->getTitle();
		
		$data['user'] = $this->load->model('Login')->user();

		return $this->view->render('partials/header', $data);
	}

}
