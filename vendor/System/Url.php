<?php 

namespace System;

/**
* class Url
*
* @author Júlio César Cabral Valente
*/
class Url
{
	/**
	* Objeto do aplicativo
	*
	* @var \System\Application
	*/
	protected $app;
	
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
	* Gerar link completo para o caminho especificado 
	*
	* @param string $path
	* @return string
	*/
	public function link($path)
	{
		return $this->app->request->baseUrl() . trim($path, '/');
	}
	
	/**
	* Redirecionar para o caminho especificado
	*
	* @param string $path
	* @return void
	*/
	public function redirectTo($path)
	{
		header('location:' . $this->link($path));
		
		exit;
	}


}
