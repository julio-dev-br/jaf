<?php 

namespace App\Controllers\Partials;

use System\Controller;

/**
* Controller SidebarUserController
*
* @author Júlio César Cabral Valente
*/
class SidebarUserController extends Controller
{
	public function index()
	{
		return $this->view->render('partials/sidebarUser');
	}

}