<?php 

namespace App\Controllers\Partials;

use System\Controller;

use System\View\ViewInterface;

/**
* Controller LayoutUserController
*
* @author Júlio César Cabral Valente
*/
class LayoutUserController extends Controller
{
	/**
	* Renderizar o layout com o objeto de exibição especificado
	*
	* @param \System\View\ViewInterface $view
	*/
	public function render(ViewInterface $view)
	{
		$data['content'] = $view;
		
		$data['header'] = $this->load->controller('partials/Header')->index();
		
		$data['sidebar'] = $this->load->controller('partials/SidebarUser')->index();
		
		$data['footer'] = $this->load->controller('partials/Footer')->index();
		
		return $this->view->render('partials/layout', $data);
	}

}
