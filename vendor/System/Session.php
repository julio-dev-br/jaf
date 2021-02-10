<?php 

namespace System;

/**
* Class Session
*
* @author Júlio César Cabral Valente
*/
class Session
{
	/**
	* Objeto da aplicação
	*
	* @var \System\Application
	*/
	private $app;
	
	/**
	* Construtor
	*
	* @param \System\Application $app
	*/
	public function __construct(Application $app)
	{
		$this->app = $app;
	}
	
	/**
	* Iniciar sessão
	*
	* @return void
	*/
	public function start()
	{
		ini_set('session.use_only_cookies', 1);
		
		if (! session_id())
		{
			session_start();
		}
	}
	
	/**
	* Definir novo valor para a sessão
	*
	* @param string $key
	* @param mixed $value
	* @return void
	*/
	public function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}
	
	/**
	* Obter valor da sessão pela chave fornecida
	*
	* @param string $key
	* @param string $default
	* @return mixed
	*/
	public function get($key, $default = null)
	{
		return array_get($_SESSION, $key, $default);
	}
	
	/**
	* Determinar se a sessão tem a chave fornecida
	*
	* @param string $key
	* @return bool
	*/
	public function has($key)
	{
		return isset($_SESSION[$key]);
	}
	
	/**
	* Remova a chave fornecida da sessão
	*
	* @param string $key
	* @return void
	*/
	public function remove($key)
	{
		unset($_SESSION[$key]);
	}
	
	/**
	* Obter valor da sessão pela chave fornecida e removê-lo
	*
	* @param string $key
	* @return mixed
	*/
	public function pull($key)
	{
		$value = $this->get($key);
		
		$this->remove($key);
		
		return $value;
	}
	
	/**
	* Obter todos os dados da sessão
	*
	* @return array
	*/
	public function all()
	{
		return $_SESSION;
	}
	
	/**
	* Destruir sessão
	*
	* @return void
	*/
	public function destroy()
	{
		session_destroy();
		
		unset($_SESSION);
	}

}









