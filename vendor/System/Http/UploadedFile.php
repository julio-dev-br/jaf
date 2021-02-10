<?php 

namespace System\Http;

use System\Application;

/**
* Class UploadedFile
*
* @author Júlio César Cabral Valente
*/
class UploadedFile
{
	/**
	* Objeto do aplicativo
	*
	* @var \System\Application
	*/
	private $app;
	
	/**
	* O arquivo enviado
	*
	* @var array 
	*/
	private $file = [];
	
	/**
	* O nome do arquivo carregado
	*
	* @var string 
	*/
	private $fileName;
	
	/**
	* O nome do arquivo carregado sem sua extensão
	*
	* @var string 
	*/
	private $nameOnly;
	
	/**
	* A extensão carregada
	*
	* @var string 
	*/
	private $extension;
	
	/**
	* O tipo de mime type do arquivo carregado
	*
	* @var string 
	*/
	private $mimeType;
	
	/**
	* O caminho do arquivo temporário carregado
	*
	* @var string 
	*/
	private $tempFile;
	
	/**
	* O tamanho do arquivo carregado em bytes
	*
	* @var int 
	*/
	private $size;
	
	/**
	* O erro do arquivo enviado
	*
	* @var int 
	*/
	private $error;
	
	/**
	* As extensões de imagem permitidas
	*
	* @var array
	*/
	private $allowedImageExtensions = ['gif', 'jpg', 'jpeg', 'png', 'webp'];
	
	/**
	* Construtor
	*
	* @param string $input
	*/
	public function __construct($input)
	{	
		$this->getFileInfo($input);
	}
	
	/**
	* Comece a coletar dados da fila carregados
	*
	* @param string $input
	* @return void
	*/
	private function getFileInfo($input)
	{
		if (empty($_FILES[$input]))
		{
			return;
		}
		
		$file = $_FILES[$input];
		
		$this->error = $file['error'];
		
		if ($this->error != UPLOAD_ERR_OK)
		{
			return;
		}
		
		$this->file = $file;
				
		$this->fileName = $this->file['name'];
		
		$fileNameInfo = pathinfo($this->fileName);
		
		$this->nameOnly = $fileNameInfo['basename'];
		
		$this->extension = strtolower($fileNameInfo['extension']);
		
		$this->mimeType = $this->file['type'];
		
		$this->tempFile = $this->file['tmp_name'];
		
		$this->size = $this->file['size'];
	}
	
	/**
	* Determinar se o arquivo foi carregado
	*
	* @return bool
	*/
	public function exists()
	{
		return ! empty($this->file);
	}
	
	/**
	* Obter nome do arquivo
	*
	* @return bool
	*/
	public function getFileName()
	{
		return $this->fileName;
	}
	
	/**
	* Obter nome do arquivo apenas sem extensão
	*
	* @return string
	*/
	public function getNameOnly()
	{
		return $this->nameOnly;
	}
	
	/**
	* Obter extensão de arquivo
	*
	* @return string
	*/
	public function getExtension()
	{
		return $this->extension;
	}
	
	/**
	* Obter mime type do arquivo
	*
	* @return string
	*/
	public function getMimeType()
	{
		return $this->mimeType;
	}
	
	/**
	* Determinar se o arquivo enviado é imagem
	*
	* @return bool
	*/
	public function isImage()
	{		
		return strpos($this->mimeType, 'image/') === 0 AND in_array($this->extension, $this->allowedImageExtensions);
	}
	
	/**
	* Mova o arquivo carregado para o destino especificado
	*
	* @param string $target
	* @param string $newFileName
	* @return string
	*/
	public function moveTo($target, $newFileName = null)
	{
		$fileName = $newFileName ?: sha1(mt_rand()) . '_' . sha1(mt_rand());
		
		$fileName .= '.' . $this->extension;
		
		if (! is_dir($target))
		{
			mkdir($target, 0777, true);
		}
		
		$uploadedFilePath = rtrim($target, '/') . '/' . $fileName;
		
		move_uploaded_file($this->tempFile, $uploadedFilePath);
		
		return $fileName;
	}
	

}






















