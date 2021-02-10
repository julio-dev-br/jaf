<?php 

namespace System\Http;

/**
* Class Request
*
* @author Júlio César Cabral Valente
*/
class Request 
{
	/**
	* Url
	*
	* @var string
	*/
	private $url;
	
	/**
	* Url base
	*
	* @var string
	*/
	private $baseUrl;
	
	/**
	* Contêiner de arquivos enviados
	*
	* @var array
	*/
	private $files = [];
	
	/**
	* Prepare url
	*
	* @return void
	*/
	public function prepareUrl()
	{
		$script = dirname($this->server('SCRIPT_NAME'));
		
		$requestUri = $this->server('REQUEST_URI');
				
		if (strpos($requestUri, '?') !== false)
		{
			list($requestUri, $queryString) = explode('?', $requestUri);
		}
		
		$this->url = rtrim(preg_replace('#'.$script.'#', '' , $requestUri), '/');
		
		if(! $this->url)
		{
			$this->url = '/';
		}
		
		$this->baseUrl = $this->server('REQUEST_SCHEME') . '://' . $this->server('HTTP_HOST') . $script . '/';
				
	}
	
	/**
	* Obter valor de _GET pela chave fornecida
	*
	* @param string $key
	* @param mixed $default
	* @return mixed
	*/
	public function get($key, $default = null)
	{
		return array_get($_GET, $key, $default);
	}
	
	/**
	* Obter valor de _POST pela chave fornecida
	*
	* @param string $key
	* @param mixed $default
	* @return mixed
	*/
	public function post($key, $default = null)
	{
		return array_get($_POST, $key, $default);
	}
	
	/**
	* Obter o objeto de arquivo carregado para a entrada fornecida
	* 
	* @param string $input
	* @return \System\Http\UploadedFile
	*/
	public function file($input)
	{
		if (isset($this->files[$input]))
		{
			return $this->files[$input];
		}
		
		$uploadedFile = new UploadedFile($input);
		
		$this->files[$input] = $uploadedFile;
		
		return $this->files[$input];
	}
	
	/**
	* Obter valor de _SERVER pela chave fornecida
	*
	* @param string $key
	* @param mixed $default
	* @return mixed
	*/
	public function server($key, $default = null)
	{
		return array_get($_SERVER, $key, $default);
	}
	
	/**
	* Obter o método de solicitação atual
	*
	* @return string
	*/
	public function method()
	{
		return $this->server('REQUEST_METHOD');
	}
	
	/**
	* Obter URL completo do script
	*
	* @return string
	*/
	public function baseUrl()
	{
		return $this->baseUrl;
	}
	
	/**
	* Obter apenas URL relativo (URL limpo)
	*
	* @return string
	*/
	public function url()
	{
		return $this->url;
	}

}
