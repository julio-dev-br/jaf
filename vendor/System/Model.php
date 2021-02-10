<?php 

namespace System;

/**
* Abstract class Model
*
* @author Júlio César Cabral Valente
*/
abstract class Model
{
	/**
	* Objeto do aplicativo
	*
	* @var \System\Application
	*/
	protected $app;
	
	/**
	* Nome da tabela no banco de dados
	*
	* @var string
	*/
	protected $table;
	
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
	* Obter todos os registros de modelo
	*
	* @return array
	*/
	public function all()
	{
		return $this->fetchAll($this->table); 
	}
	
	/**
	* Obter registro por ID
	*
	* @param int $id
	* return \stdClass | null
	*/
	public function get($id)
	{
		return $this->where('id = ' . $id)->fetch($this->table);
	}

	/**
	* Determinar se o valor fornecido da chave existe na tabela
	*
	* @param mixed $value
	* @param string $key
	* @return bool
	*/
	public function exists($value, $key = 'id')
	{
		return (bool)$this->select($key)->where($key . ' = ?' , $value)->fetch($this->table);
	}

	/**
	* Excluir registro na tabela por id
	*
	* @param $id
	* @return void
	*/
	public function delete($id)
	{
		return $this->where('id = ' . $id)->delete($this->table);
	}

	/**
	* Converte a data para o fromato do banco de dados
	*
	* @param $data
	* @return string
	*/
	public function dateFormat($data)
	{
		$rData = implode("-", array_reverse(explode("/", trim($data))));

		return $rData;
	}
	
	/**
	* Chamar objetos de aplicativos compartilhados dinamicamente 
	*
	* @param string $key
	* @return mixed
	*/
	public function __get($key)
	{
		return $this->app->get($key);
	}
	
	/**
	* Chamar métodos de banco de dados dinamicamente
	*
	* @param string $method
	* @param array $args
	* @return mixed
	*/
	public function __call($method, $args)
	{
		return call_user_func_array([$this->app->db, $method], $args);
	}
}
