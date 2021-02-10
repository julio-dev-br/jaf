<?php 

namespace System;

/**
* Class Loader
*
* @author Júlio César Cabral Valente
*/
class Loader
{
	/**
	* Objeto do aplicativo
	*
	* @var \System\Application
	*/
	private $app;
	
	/**
	* Container de controladores
	*
	* @var array 
	*/
	private $controllers = [];
	
	/**
	* Container de modelos
	*
	* @var array 
	*/
	private $models = [];
	
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
	* Chame o controlador fornecido com o método fornecido e passe os argumentos fornecidos para o método do controlador
	*
	* @param string $controller
	* @param string $method
	* @param array $arguments
	* @return mixed 
	*/
	public function action($controller, $method, array $arguments)
	{
		$object = $this->controller($controller);
		
		return call_user_func_array([$object, $method], $arguments);
	}
	
	/**
	* Chame o controlador fornecido
	*
	* @param string $controller
	* @return object 
	*/
	public function controller($controller)
	{
		$controller = $this->getControllerName($controller);
		
		if (! $this->hasController($controller))
		{
			$this->addController($controller);
		}
		
		return $this->getController($controller);
	}
	
	/**
	* Determine se a classe especificada | controlador existe no contêiner de controladores
	*
	* @param string $controller
	* @return bool 
	*/
	private function hasController($controller)
	{
		return array_key_exists($controller, $this->controllers);
	}
	
	/**
	* Crie um novo objeto para o controlador especificado e armazene-o no contêiner de controladores
	*
	* @param string $controller
	* @return void 
	*/
	private function addController($controller)
	{		
		$object = new $controller($this->app);
		
		$this->controllers[$controller] = $object;
	}
	
	/**
	* Obter o objeto do controlador
	*
	* @param string $controller
	* @return object 
	*/
	private function getController($controller)
	{
		return $this->controllers[$controller];
	}
	
	/**
	* Obter o nome completo da classe para o controlador especificado
	*
	* @param string $controller
	* @return string 
	*/
	private function getControllerName($controller)
	{
		$controller .= 'Controller';
		
		$controller = 'App\\Controllers\\' . $controller;
		
		return str_replace('/', '\\', $controller);
	}
	
	/**
	* Chame o modelo fornecido
	*
	* @param string $model
	* @return object 
	*/
	public function model($model)
	{
		$model = $this->getModelName($model);
		
		if (! $this->hasModel($model))
		{
			$this->addModel($model);
		}
		
		return $this->getModel($model);
	}
	
	/**
	* Determinar se a classe fornecida existe no contêiner de modelos
	*
	* @param string $model
	* @return bool 
	*/
	private function hasModel($model)
	{
		return array_key_exists($model, $this->models);
	}
	
	/**
	* Crie um novo objeto para o modelo especificado e armazene-o no contêiner de modelos
	*
	* @param string $model
	* @return void 
	*/
	private function addModel($model)
	{
		$object = new $model($this->app);
		
		$this->models[$model] = $object;
	}
	
	/**
	* Obter o objeto de modelo
	*
	* @param string $model
	* @return object 
	*/
	private function getModel($model)
	{
		return $this->models[$model];
	}
	
	/**
	* Obter o nome completo da classe para o modelo especificado
	*
	* @param string $model
	* @return string 
	*/
	private function getModelName($model)
	{
		$model .= 'Model';
		
		$model = 'App\\Models\\' . $model;
		
		return str_replace('/', '\\', $model);
	}
	
}
