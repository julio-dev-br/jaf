<?php 

namespace App\Controllers\Partials;

use System\Controller;

/**
* Controller SidebarGPController
*
* @author Júlio César Cabral Valente
*/
class SidebarGPController extends Controller
{
	public function index()
	{
		return $this->view->render('partials/sidebarGP');
	}

}