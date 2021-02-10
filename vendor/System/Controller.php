<?php 

namespace System;

/**
* Abstract class Controller
*
* @author Júlio César Cabral Valente
*/
abstract class Controller
{
	/**
	* Objeto do aplicativo
	*
	* @var \System\Application
	*/
	protected $app;
	
	/**
	* Contêiner de erros
	*
	* @var array
	*/
	protected $errors = [];
	
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
	* Codifique o valor fornecido para json
	*
	* @param mixed $data
	* @return string
	*/
	public function json($data)
	{
		return json_encode($data);
	}

	/**
	* Chamar objetos de aplicativos compartilhados dinamicamente 
	*
	* @param string $key
	* @return mixed
	*/
	public function __get($key)
	{
		return $this->app->get($key);
	}
	

}
