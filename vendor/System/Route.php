<?php 

namespace System;

/**
* Class Route
*
* @author Júlio César Cabral Valente
*/
class Route
{
	/**
	* Objeto do aplicativo
	*
	* @var \System\Application
	*/
	private $app;
	
	/**
	* Container de rotas
	*
	* @var array 
	*/
	private $routes = [];
	
	/**
	* URL não encontrado
	*
	* @var string
	*/
	private $notFound;
	
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
	* Adicionar nova rota
	*
	* @param string $url
	* @param string $action
	* @param string $requestMethod
	* @return void
	*/
	public function add($url, $action, $requestMethod = 'GET')
	{
		$route = [
			'url'     => $url,
			'pattern' => $this->generatePattern($url),
			'action'  => $this->getAction($action),
			'method'  => strtoupper($requestMethod),
		];
		
		$this->routes[] = $route;
	}
	
	/**
	* URL do conjunto não encontrado
	*
	* @param string $url
	* @return void
	*/
	public function notFound($url)
	{
		$this->notFound = $url;
	}
	
	/**
	* Obter rota adequada
	*
	* @return array
	*/
	public function getProperRoute()
	{
		foreach ($this->routes as $route)
		{
			if ($this->isMatching($route['pattern']) AND $this->isMatchingRequestMethod($route['method']))
			{
				$arguments = $this->getArgumentsFrom($route['pattern']);
				
				list($controller, $method) = explode('@', $route['action']);
				
				return [$controller, $method, $arguments];
			}
		}
		
		return $this->app->url->redirectTo($this->notFound);
	}
	
	/**
	* Determine se o padrão fornecido corresponde ao URL atual
	*
	* @return string $pattern
	* @return bool
	*/
	private function isMatching($pattern)
	{
		return preg_match($pattern, $this->app->request->url());
	}
	
	/**
	* Determinar se o método de solicitação atual é igual ao método de rota fornecido
	*
	* @param string $routeMethod
	* @return bool
	*/
	private function isMatchingRequestMethod($routeMethod)
	{
		return $routeMethod == $this->app->request->method();
	}
	
	/**
	* Obter argumentos do URL de solicitação atual com base no padrão fornecido
	*
	* @return string $pattern
	* @return array
	*/
	private function getArgumentsFrom($pattern)
	{
		preg_match($pattern, $this->app->request->url(), $matches);
		
		array_shift($matches);
		
		return $matches;
	}
	
	/**
	* Gere um padrão regex para o URL especificado
	*
	* @param string $url
	* @return string
	*/
	private function generatePattern($url)
	{
		$pattern = '#';
		
		$pattern .= str_replace([':text', ':id'], ['([a-zA-Z0-9-]+)', '(\d+)'], $url);
		
		$pattern .= '$#';
		
		return $pattern ;
	}
	
	/**
	* Obter a ação adequada 
	*
	* @param string $action
	* @return string
	*/
	private function getAction($action)
	{
		$action = str_replace('/', '\\', $action);
		
		return strpos($action, '@') !== false ? $action : $action . '@index';
	}
	
}
















