<?php 

namespace App\Controllers;

use System\Controller;

/**
 * Controller PessoaFisicaController
 * 
 * @author Júlio César Cabral Valente
 */
class PessoaFisicaController extends Controller
{
    /**
     * Exibir a lista de Pessoas Físicas
     * 
     * @return mixed
     * 
    */
    public function index()
    {
        $loginModel = $this->load->model('Login');

        if (! $loginModel->isLogged()) 
        {
            return $this->url->redirectTo('/login');
        }

        $this->html->setTitle('Pessoas Físicas');
        $view = $this->view->render('pessoa-fisica/list');

        return $this->LayoutGP->render($view);
    }
}

