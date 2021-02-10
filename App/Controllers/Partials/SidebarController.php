<?php 

namespace App\Controllers\Partials;

use System\Controller;

/**
* Controller SidebarController
*
* @author Júlio César Cabral Valente
*/
class SidebarController extends Controller
{
	public function index()
	{
		return $this->view->render('partials/sidebar');
	}

}
