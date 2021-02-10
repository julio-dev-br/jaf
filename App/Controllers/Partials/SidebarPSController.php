<?php 

namespace App\Controllers\Partials;

use System\Controller;

/**
* Controller SidebarPSController
*
* @author Júlio César Cabral Valente
*/
class SidebarPSController extends Controller
{
	public function index()
	{
		return $this->view->render('partials/sidebarPS');
	}

}