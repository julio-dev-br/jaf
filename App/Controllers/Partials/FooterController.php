<?php 

namespace App\Controllers\Partials;

use System\Controller;

/**
* Controller FooterController
*
* @author Júlio César Cabral Valente
*/
class FooterController extends Controller
{
	public function index()
	{
		return $this->view->render('partials/footer');
	}

}
