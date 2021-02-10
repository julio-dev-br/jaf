<?php 

namespace System;

/**
* Class File
*
* @author Júlio César Cabral Valente
*/
class File
{
	/**
	* Separador de diretório
	*
	* @const string
	*/
	const DS = DIRECTORY_SEPARATOR;
	
	/**
	* Caminho raiz
	*
	* @var string
	*/
	private $root;
	
	/**
	* Contrutor
	*
	* @var string
	*/
	public function __construct($root)
	{
		$this->root = $root;
	}
	
	/**
	* Determine se existe o caminho do arquivo especificado
	*
	* @param string $file
	* @return bool
	*/
	public function exists($file)
	{
		return file_exists($this->to($file));
	}
	
	/**
	* Exigir o arquivo fornecido
	*
	* @param string $file
	* @return mixed
	*/
	public function requireFile($file)
	{
		return require $this->to($file);
	}
	
	/**
	* Gere o caminho completo para o caminho especificado na pasta vendor
	*
	* @param string $path
	* @return string
	*/
	public function toVendor($path)
	{
		return $this->to('vendor/' . $path);
	}

	/**
	* Gere o caminho completo para o caminho especificado na pasta public
	*
	* @param string $path
	* @return string
	*/
	public function toPublic($path)
	{
		return $this->to('public/' . $path);
	}
	
	/**
	* Gerar caminho completo para o caminho especificado
	*
	* @param string $path
	* @return string
	*/
	public function to($path)
	{
		return $this->root . static::DS . str_replace(['/', '\\'], static::DS, $path);
	}
	
	
	
	
}
