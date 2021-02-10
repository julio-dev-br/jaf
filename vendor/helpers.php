<?php 

use System\Application;

if (! function_exists('pre')) {

	/**
	* Visualize a variável fornecida no navegador
	*
	* @param mixed $var
	* @return void
	*/
	function pre($var)
	{
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}
}

if (! function_exists('pred')) {

	/**
	* Visualize a variável fornecida no navegador e sair da aplicação
	*
	* @param mixed $var
	* @return void
	*/
	function pred($var)
	{	
		pre($var);
		die;
	}
}

if (! function_exists('array_get')) {

	/**
	* Obtenha o valor da matriz fornecida para o dado encontrado, caso contrário, obtenha o valor padrão
	*
	* @param array $array
	* @param string|int $key
	* @param string $default
	*/
	function array_get($array, $key, $default = null)
	{
		return isset($array[$key]) ? $array[$key] : $default;
	}
}

if (! function_exists('_e')) {

	/**
	* Escapar do valor fornecido
	*
	* @param string $value
	* @return string
	*/
	function _e($value)
	{
		return htmlspecialchars($value);
	}
}

if (! function_exists('assets')) {

	/**
	* Gerar caminho completo para o caminho especificado no diretório público
	*
	* @param string $path
	* @return string
	*/
	function assets($path)
	{
		$app = Application::getInstance();
		
		return $app->url->link('public/' . $path);
	}
}

if (! function_exists('url')) {

	/**
	* Gerar caminho completo para o caminho especificado
	*
	* @param string $path
	* @return string
	*/
	function url($path)
	{
		$app = Application::getInstance();
		
		return $app->url->link($path);
	}
}
























