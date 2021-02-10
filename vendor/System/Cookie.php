<?php 

namespace System;

/**
* Class Cookie
*
* @author Júlio César Cabral Valente
*/
class Cookie
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
	* Definir novo valor para cookie
	*
	* @param string $key
	* @param mixed $value
	* @param int $hours
	* @return void
	*/
	public function set($key, $value, $hours = 1800)
	{
		setcookie($key, $value, time() + $hours * 3600, '', '', false, true);
	}
	
	/**
	* Obter valor do cookie pela chave fornecida
	*
	* @param string $key
	* @param string $default
	* @return mixed
	*/
	public function get($key, $default = null)
	{
		return array_get($_COOKIE, $key, $default);
	}
	
	/**
	* Determinar se o cookie tem a chave fornecida
	*
	* @param string $key
	* @return bool
	*/
	public function has($key)
	{
		return array_key_exists($key, $_COOKIE);
	}
	
	/**
	* Remova a chave fornecida do cookie
	*
	* @param string $key
	* @return void
	*/
	public function remove($key)
	{
		setcookie($key, null, -1);
		
		unset($_COOKIE[$key]);
	}
	
	/**
	* Obter todos os dados do cookie
	*
	* @return array
	*/
	public function all()
	{
		return $_COOKIE;
	}
	
	/**
	* Destruir cookie
	*
	* @return void
	*/
	public function destroy()
	{
		foreach (array_keys($this->all()) as $key)
		{
			$this->remove($key);
		}
		
		unset($_COOKIE);
	}

}









