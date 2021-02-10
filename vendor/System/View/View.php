<?php 

namespace System\View;

use System\File;

/**
* Class View
*
* @author Júlio César Cabral Valente
*/
class View implements ViewInterface
{
	/**
	* Objeto de arquivo
	*
	* @var \System\File
	*/
	private $file;
	
	/**
	* Exibir caminho
	*
	* @var string
	*/
	private $viewPath;
	
	/**
	* Variáveis ​​de dados transmitidas para o caminho especificado
	*
	* @var array
	*/
	private $data = [];
	
	/**
	* A saída do arquivo de visualização
	*
	* @var string
	*/
	private $output;
	
	/**
	* Construtor
	*
	* @param string $viewPath
	* @return void
	*/
	public function __construct(File $file, $viewPath, array $data)
	{
		$this->file = $file;
		
		$this->preparePath($viewPath);
		
		$this->data = $data;
	}
	
	/**
	* Preparar o caminho da visualização
	*
	* @param string $viewPath
	* @return void
	*/
	private function preparePath($viewPath)
	{
		$relativeViewPath = 'App/Views/' . $viewPath . '.php';
		
		$this->viewPath = $this->file->to($relativeViewPath);
		
		if (! $this->viewFileExists($relativeViewPath))
		{
			die('<b>' . $viewPath . '</b>' . ' não existe na pasta de visualização');
		}
	}
	
	/**
	* Determinar se o caminho da visualização existe
	*
	* @param string $viewPath
	* @return bool
	*/
	private function viewFileExists($viewPath) 
	{
		return $this->file->exists($viewPath);
	}
	
	/**
	* {@inheritDoc}
	*/
	public function getOutput() 
	{
		if (is_null($this->output))
		{
			ob_start();
			
			extract($this->data);
		
			require $this->viewPath;
		
			$this->output = ob_get_clean();
		}
			
		return $this->output;
	}
	
	/**
	* {@inheritDoc}
	*/
	public function __toString() 
	{
		return $this->getOutput();
	}
}
