<?php 

namespace System;

/**
* Class Html
*
* @author Júlio César Cabral Valente
*/
class Html
{
	/**
	* Objeto da aplicação
	*
	* @var \System\Application
	*/
	private $app;
	
	/**
	* Título em HTML
	*
	* @var string
	*/
	private $title;
	
	/**
	* Descrição em HTML
	*
	* @var string
	*/
	private $description;
	
	/**
	* Palavras-chave em HTML
	*
	* @var string
	*/
	private $keywords;
	
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
	* Definir título
	*
	* @param string $title
	* @return void
	*/
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	* Obter título
	*
	* @return string
	*/
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	* Definir descrição
	*
	* @param string $description
	* @return void
	*/
	public function setDescription($descrption)
	{
		$this->description = $description;
	}
	
	/**
	* Obter descrição
	*
	* @return string
	*/
	public function getDescription()
	{
		return $this->description;
	}
	
	/**
	* Definir palavras-chave
	*
	* @param string $keywords
	* @return void
	*/
	public function setKeywords($keywords)
	{
		$this->keywords = $keywords;
	}
	
	/**
	* Obter palavras-chave
	*
	* @return string
	*/
	public function getKeywords()
	{
		return $this->keywords;
	}
	
}

