<?php

namespace System\View;

use System\Application;

/**
* Class ViewFactory
*
* @author Júlio César Cabral Valente
*/
class ViewFactory
{
	/**
	* Objeto do aplicativo
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
	* Renderize o caminho de exibição fornecido com as variáveis ​​passadas e gere 
	*
	* @param string $viewPath 
	* @param array $data
	* @return \System\View\ViewInterface
	*/
	public function render($viewPath, array $data = [])
	{
		return new View($this->app->file, $viewPath, $data);
	}
	
}
