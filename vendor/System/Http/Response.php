<?php 

namespace System\Http;

use System\Application;

/**
* Class Response
*
* @author Júlio César Cabral Valente
*/
class Response
{
	/**
	* Objeto do aplicativo
	*
	* @var \System\Application
	*/
	private $app;
	
	/**
	* Contêiner de cabeçalhos que será enviado ao navegador
	*
	* @var array
	*/
	private $headers = [];
	
	/**
	* O conteúdo que será enviado ao navegador
	*
	* @var string
	*/
	private $content = '';
	
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
	* Defina o conteúdo da saída de resposta
	*
	* @param string $content
	* @return void
	*/
	public function setOutput($content)
	{
		$this->content = $content;
	}
	
	/**
	* Defina os cabeçalhos de resposta
	*
	* @param string $header
	* @param mixed $value
	* @return void
	*/
	public function setHeader($header, $value)
	{
		$this->headers[$header] = $value;
	}
	
	/**
	* Envie os cabeçalhos e o conteúdo da resposta
	*
	* @return void
	*/
	public function send()
	{
		$this->sendHeaders();
		
		$this->sendOutput();
	}
	
	/**
	* Envie os cabeçalhos de resposta
	*
	* @return void
	*/
	private function sendHeaders() 
	{
		foreach ($this->headers as $value)
		{
			header($header . ':' . $value);
		}
	}
	
	/**
	* Envie a saída de resposta
	*
	* @return void
	*/
	private function sendOutput() 
	{
		echo $this->content;
	}
	
	
}
