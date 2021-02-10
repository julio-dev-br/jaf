<?php 

namespace App\Controllers;

use System\Controller;

/**
* Controller NotFoundController
*
* @author Júlio César Cabral Valente
*/
class NotFoundController extends Controller
{
	public function index()
	{
		return $this->view->render('not-found');
	}

}
