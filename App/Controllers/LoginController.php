<?php 

namespace App\Controllers;

use System\Controller;

/**
* Controller LoginController
*
* @author Júlio César Cabral Valente
*/
class LoginController extends Controller
{
	/**
	* Exibir formulário de login
	*
	* return mixed
	*/
	public function index()
	{
		$loginModel = $this->load->model('Login');
		
		if ($loginModel->isLogged())
		{
			 return $this->url->redirectTo('/dashboard');
		}
	
		$data['errors'] = $this->errors;
		$data['title'] = 'Login';
		
		return $this->view->render('login', $data);
	}
	
	/**
	* Enviar formulário de login
	*
	* return mixed
	*/
	public function submit()
	{
		if ($this->isValid())
		{
			$loginModel = $this->load->model('Login');
			
			$loggedInUser = $loginModel->user(); 
			
			if ($this->request->post('remember'))
			{
				// Salvar dados de login no cookie
				$this->cookie->set('login', $loggedInUser->codigo);
			}
			else
			{
				// Salvar dados de login na session
				$this->session->set('login', $loggedInUser->codigo);
			}

			$fullName = $loggedInUser->nome;
			$firstName = explode(" ", $fullName);
			
			$json = [];
			
			$json['success'] = 'Bem Vindo de volta ' . $firstName[0];
			
			$json['redirect'] = $this->url->link('/dashboard');
			
			return $this->json($json);
		}
		else
		{
			$json = [];
			
			$json['errors'] = implode('<br>', $this->errors);
			
			return $this->json($json);
		}
	}
	
	/**
	* Validar formulário de login
	*
	* return bool
	*/
	private function isValid()
	{
		$user    = $this->request->post('user');
		$password = $this->request->post('password');
		
		if (! $user)
		{
			$this->errors[] = 'Por favor insira seu usuário';
		}
		// elseif (! filter_var($email, FILTER_VALIDATE_EMAIL))
		// {
		// 	$this->errors[] = 'Por favor insira um email válido';
		// }
		
		if (! $password)
		{
			$this->errors[] = 'Por favor insira sua senha';
		}
		
		if (! $this->errors)
		{
			$loginModel = $this->load->model('Login');
		
			if (! $loginModel->isValidLogin($user, $password))
			{
				$this->errors[] = 'Dados de login inválidos';
			}
		}
				
		return empty($this->errors);
	}

}























