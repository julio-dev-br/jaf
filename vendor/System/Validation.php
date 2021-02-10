<?php 

namespace System;

/**
* Class Validation
*
* @author Júlio César Cabral Valente
*/
class Validation
{
	/**
	* Objeto do aplicativo
	*
	* @var \System\Application
	*/
	private $app;
	
	/**
	* Contêiner de erros
	*
	* @var array
	*/
	private $errors = [];
	
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
	* Determine se a entrada fornecida não está vazia
	*
	* @param string $inputName
	* @param string $customErrorMessage
	*/
	public function required($inputName, $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName))
		{
			return $this;
		}
		
		$inputValue = $this->value($inputName);
		
		if ($inputValue === '') 
		{
			$message = $customErrorMessage ?: sprintf('%s obrigatório', ucfirst($inputName));
			
			$this->addError($inputName, $message);
		}
		
		return $this;
	}

	/**
	* Determine se o arquivo de entrada fornecido existe
	*
	* @param string $inputName
	* @param string $customErrorMessage
	* @return $this
	*/
	public function requiredFile($inputName, $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName))
		{
			return $this;
		}

		$file = $this->app->request->file($inputName);

		if (! $file->exists()) 
		{
			$message = $customErrorMessage ?: sprintf('%s obrigatório', ucfirst($inputName));
			
			$this->addError($inputName, $message);
		}

		return $this;
	}

		/**
	* Determine se o arquivo de entrada é uma imagem
	*
	* @param string $inputName
	* @param string $customErrorMessage
	* @return $this
	*/
	public function image($inputName, $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName))
		{
			return $this;
		}

		$file = $this->app->request->file($inputName);

		if (! $file->exists()) 
		{
			return $this;
		}

		if (! $file->isImage()) 
		{
			$message = $customErrorMessage ?: sprintf('%s não é válida', ucfirst($inputName));
			
			$this->addError($inputName, $message);
		}

		return $this;
	}

	/**
	 * Determinar se a entrada fornecida é uma data válida
	 * 
	 * @param string $inputName
	 * @param string $customErrorMessage
	*/
	public function date($inputName, $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName)) 
		{
			return $this;
		}

		$inputValue = $this->value($inputName);

		if (!empty($inputValue))
		{
			$data = explode('/', $inputValue);

			if(!preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/", $inputValue)) 
			{
				$message = $customErrorMessage ?: sprintf('%s inválida', ucfirst($inputName));
	
				$this->addError($inputName, $message);
			}
			elseif(! checkdate($data[1], $data[0], $data[2]))
			{
				$message = $customErrorMessage ?: sprintf('%s inválida', ucfirst($inputName));
	
				$this->addError($inputName, $message);
			}

		}

		return $this;	

	}
		
	/**
	* Determinar se a entrada fornecida é um email válido
	*
	* @param string $inputName
	* @param string $customErrorMessage
	*/
	public function email($inputName, $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName))
		{
			return $this;
		}
		
		$inputValue = $this->value($inputName);
		
		if (! filter_var($inputValue, FILTER_VALIDATE_EMAIL) && !empty($inputValue))
		{
			$message = $customErrorMessage ?: sprintf('%s inválido', ucfirst($inputName));
			
			$this->addError($inputName, $message);
		}
		
		return $this;
	}

	/**
	* Determinar se a entrada fornecida é um cpf válido
	*
	* @param string $inputName
	* @param string $customErrorMessage
	*/
	public function cpf($inputName, $customErrorMessage = null)
	{

		if ($this->hasErrors($inputName))
		{
			return $this;
		}

		$inputValue = $this->value($inputName);

		// Extrai somente os números
		$inputValue = preg_replace( '/[^0-9]/is', '', $inputValue);

	    // Verifica se foi informado todos os digitos corretamente
	    if (strlen($inputValue) != 11 && !empty($inputValue)) {
	        
	        $message = $customErrorMessage ?: sprintf('%s inválido', ucfirst($inputName));
			
			$this->addError($inputName, $message);
	    }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
	    if (preg_match('/(\d)\1{10}/', $inputValue) && !empty($inputValue)) 
	    {
	        $message = $customErrorMessage ?: sprintf('%s inválido', ucfirst($inputName));
			
			$this->addError($inputName, $message);
	    }

	    return $this;

	}

	/**
	* Determine se a entrada fornecida é um valor flutuante
	*
	* @param string $inputName
	* @param string $customErrorMessage
	*/
	public function float($inputName, $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName))
		{
			return $this;
		}
		
		$inputValue = $this->value($inputName);
		
		if (! is_float($inputValue))
		{
			$message = $customErrorMessage ?: sprintf('%s Aceita apenas números decimais', ucfirst($inputName));
			
			$this->addError($inputName, $message);
		}
		
		return $this;
	}
	
	/**
	* Determina se o valor de entrada especificado deve ter pelo menos o comprimento especificado
	*
	* @param string $inputName
	* @param int $length
	* @param string $customErrorMessage
	*/
	public function minLen($inputName, $length, $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName))
		{
			return $this;
		}
		
		$inputValue = $this->value($inputName);
		
		if (strlen($inputValue) < $length && !empty($inputValue))
		{
			$message = $customErrorMessage ?: sprintf('%s deve ter pelo menos %s caracteres', ucfirst($inputName), $length);
			
			$this->addError($inputName, $message);
		}
		
		return $this;
	}
	
	/**
	* Determine se o valor de entrada especificado deve ter no máximo o comprimento especificado
	*
	* @param string $inputName
	* @param int $length
	* @param string $customErrorMessage
	*/
	public function maxLen($inputName, $length, $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName))
		{
			return $this;
		}
		
		$inputValue = $this->value($inputName);
		
		if (strlen($inputValue) > $length && !empty($inputValue))
		{
			$message = $customErrorMessage ?: sprintf('%s deve ser no máximo %s', ucfirst($inputName), $length);
			
			$this->addError($inputName, $message);
		}
		
		return $this;
	}
	
	/**
	* Determine se a primeira entrada corresponde à segunda entrada
	*
	* @param string $firstInput
	* @param int $secondInput
	* @param string $customErrorMessage
	*/
	public function match($firstInput, $secondInput, $customErrorMessage = null)
	{
		$firstInputValue = $this->value($firstInput);
		
		$secondInputValue = $this->value($secondInput);
		
		if ($firstInputValue != $secondInputValue)
		{
			$message = $customErrorMessage ?: sprintf('%s deve corresponder %s', ucfirst($secondInput), ucfirst($firstInput));
			
			$this->addError($secondInput, $message);
		}
		
		return $this;
	}
	
	/**
	* Determinar se a entrada fornecida é exclusiva no banco de dados
	*
	* @param string $inputName
	* @param array $databaseData
	* @param string $customErrorMessage
	*/
	public function unique($inputName, array $databaseData, $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName))
		{
			return $this;
		}
		
		$inputValue = $this->value($inputName);
		
		$table = null;
		$column = null;
		$exceptionColumn = null;
		$exceptionColumnValue = null;
		
		if (count($databaseData) == 2)
		{
			list($table, $column) = $databaseData;
		}
		elseif (count($databaseData) == 4)
		{
			list($table, $column, $exceptionColumn, $exceptionColumnValue) = $databaseData;
		}
		
		if ($exceptionColumn AND $exceptionColumnValue) 
		{
			$result = $this->app->db->select($column)
						   ->from($table)
						   ->where($column . ' = ? AND ' . $exceptionColumn . ' != ? ' , $inputValue, $exceptionColumnValue)
						   ->fetch();
		}
		else 
		{
			$result = $this->app->db->select($column)
							->from($table)
							->where($column . ' = ? ' , $inputValue)
							->fetch();
		}
		
		if ($result)
		{
			$message = $customErrorMessage ?: sprintf('%s já existe', ucfirst($inputName));
			
			$this->addError($inputName, $message);
		}

	}
	
	/**
	* Adicionar mensagem personalizada
	*
	* @param string $message
	* @return @this
	*/
	public function message($message)
	{
		$this->errors[] = $message;
		
		return $this;
	}
	
	/**
	* Validar todas as entradas
	*
	* @return @this
	*/
	public function validate() { }
	
	/**
	* Determine se existem entradas inválidas
	*
	* @return bool
	*/
	public function fails()
	{
		return ! empty($this->errors);
	}
	
	/**
	* Determinar que todas as entradas são válidas
	*
	* @return bool
	*/
	public function passes()
	{
		return empty($this->errors);
	}
	
	/**
	* Obter todos os erros
	*
	* @return bool
	*/
	public function getMessages()
	{
		return $this->errors;
	}
	
	/**
	* Comprimir erros e torná-los como uma cadeia implodida com quebra
	*
	* @return string
	*/
	public function flattenMessages()
	{
		return implode('<br>', $this->errors);
	}
	
	/**
	* Obtenha o valor para o nome de entrada especificado
	*
	* @param string $input
	* @return mixed
	*/
	private function value($input)
	{
		return $this->app->request->post($input);
	}
	
	/**
	* Adicionar erro de entrada
	*
	* @param string $inputName
	* @param string $errorMessage
	* @return void
	*/
	private function addError($inputName, $errorMessage)
	{
		$this->errors[$inputName] = $errorMessage;
	}
	
	/**
	* Determine se a entrada fornecida possui erros anteriores 
	*
	* @param string $inputName
	* @return void
	*/
	private function hasErrors($inputName)
	{
		return array_key_exists($inputName, $this->errors);
	}

}
























