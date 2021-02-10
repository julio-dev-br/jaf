<?php 

namespace System;

use PDO;
use PDOException;

/**
* Class Database
*
* @author Júlio César Cabral Valente
*/
class Database
{
	/**
	* Objeto do aplicativo
	*
	* @var \System\Application
	*/
	private $app;
	
	/**
	* Conexão PDO
	*
	* @var \PDO
	*/
	private static $connection;
	
	/**
	* Nome da tabela
	*
	* @var string
	*/
	private $table;
	
	/**
	* Contêiner de dados
	*
	* @var array
	*/
	private $data = [];
	
	/**
	* Contêiner de ligações
	*
	* @var array
	*/
	private $bindings = [];
	
	/**
	* último código de inserção
	*
	* @var int
	*/
	private $lastId;
	
	/**
	* Cláusulas where
	*
	* @var array
	*/
	private $wheres = [];
	
	/**
	* Cláusula select
	*
	* @var array
	*/
	private $selects = [];
	
	/**
	* Cláusula joins
	*
	* @var array
	*/
	private $joins = [];
	
	/**
	* Limit
	*
	* @var int
	*/
	private $limit;
	
	/**
	* Offset
	*
	* @var int
	*/
	private $offset;
	
	/**
	* Total de linhas
	*
	* @var int
	*/
	private $rows = 0;
	
	/**
	* Order By
	*
	* @var array
	*/
	private $orderBy = [];
	
	/**
	* Construtor
	*
	* @param \System\Application $app 
	*/
	public function __construct(Application $app)
	{
		$this->app = $app;
		
		if (! $this->isConnected())
		{
			$this->connect();
		}
	}
	
	/**
	* Determinar se há alguma conexão com o banco de dados
	*
	* @return bool
	*/
	private function isConnected()
	{
		return static::$connection instanceof PDO;
	}
	
	/**
	* Conectar-se ao banco de dados
	*
	* @return void
	*/
	private function connect()
	{
		$connectionData = $this->app->file->requireFile('config.php');
		
		extract($connectionData);
		
		try
		{
			static::$connection = new PDO('mysql:host=' . $server . ';dbname=' . $dbname, $dbuser, $dbpass);
			
			static::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			
			static::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			static::$connection->exec('SET NAMES utf8');
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}				
	}
	
	/**
	* Obter objeto de conexão com o banco de dados PDO
	*
	* @return \PDO
	*/
	public function connection()
	{
		return static::$connection;
	}
	
	/**
	* Definir cláusula de seleção
	*
	* @param string $select
	* @return $this
	*/
	public function select($selects)
	{
		$selects = func_get_args();

		$this->selects = array_merge($this->selects, $selects);
		
		return $this;
	}
	
	/**
	* Definir cláusula de junção de conjunto
	*
	* @param string $join
	* @return $this
	*/
	public function join($join)
	{
		$this->joins[] = $join;

		return $this;
	}
	
	/**
	* Definir ordem por cláusula
	*
	* @param string $column
	* @param string $sort
	* return $this
	*/
	public function orderBy($orderBy, $sort = 'ASC')
	{
		$this->orderBy = [$orderBy, $sort];
		
		return $this;
	}
	
	/**
	* Definir limite e deslocamento
	*
	* @param int $limit
	* @param int $offset
	* @return $this
	*/
	public function limit($limit, $offset = 0)
	{
		$this->limit = $limit;
		
		$this->offset = $offset;
		
		return $this;
	}
	
	/**
	* Buscar tabela, isso retornará apenas um registro
	*
	* @param string $table
	* @return \stdClass | null
	*/
	public function fetch($table = null)
	{
		if ($table)
		{
			$this->table = $table;
		}
		
		$sql = $this->fetchStatement();
		
		$result = $this->query($sql, $this->bindings)->fetch();
		
		$this->reset();
		
		return $result;
	}
	
	/**
	* Buscar todos os registros da tabela
	*
	* @param string $table
	* @return array
	*/
	public function fetchAll($table = null)
	{
		if ($table)
		{
			$this->table = $table;
		}
		
		$sql = $this->fetchStatement();
		
		$query = $this->query($sql, $this->bindings);
		
		$results = $query->fetchAll();
		
		$this->rows = $query->rowCount();
		
		$this->reset();
		
		return $results;
	}
	
	/**
	* Obter o total de linhas da última busca de todas as instruções
	*
	* @return int
	*/
	public function rows()
	{
		return $this->rows;
	}
	
	/**
	* Preparar declaração de seleção
	*
	* @return string
	*/
	private function fetchStatement()
	{
		$sql = 'SELECT ';
		
		if ($this->selects)
		{
			$sql .= implode(',' , $this->selects);	
		}
		else
		{
			$sql .= '*';
		}
		
		$sql .= ' FROM ' . $this->table . ' ';
		
		if ($this->joins)
		{
			$sql .= implode(' ' , $this->joins);
		}
		
		if ($this->wheres)
		{
			$sql .= ' WHERE ' . implode(' ' , $this->wheres) . ' ';
		}
		
		if ($this->limit)
		{
			$sql .= ' LIMIT ' . $this->limit; 
		}
		
		if ($this->offset)
		{
			$sql .= ' OFFSET ' . $this->offset; 
		}
		
		if ($this->orderBy)
		{
			$sql .= ' ORDER BY ' . implode(' ' , $this->orderBy); 
		}
		
		return $sql;
	}

	/**
	* Defina o nome da tabela 
	*
	* @var string $table
	* @return $this
	*/
	public function table($table)
	{
		$this->table = $table;
		
		return $this;
	}
	
	/**
	* Determine qual tabela
	*
	* @var string $table
	* @return $this
	*/
	public function from($table)
	{
		return $this->table($table);
	}
	
	/**
	* Defina os dados que serão armazenados na tabela do banco de dados
	*
	* @param mixed $key
	* @param mixed $value
	* @return $this
	*/
	public function data($key, $value = null)
	{
		if (is_array($key))
		{
			$this->data = array_merge($this->data, $key);
			
			$this->addToBindings($key);
		}
		else 
		{
			$this->data[$key] = $value;
			
			$this->addToBindings($value);
		}
		
		return $this;
	}
	
	/**
	* Inserir dados no banco de dados 
	*
	* @param string $table
	* @return $this
	*/
	public function insert($table = null)
	{
		if ($table)
		{
			$this->table($table);
		}
		
		$sql = 'INSERT INTO ' . $this->table . ' SET ';
		
		$sql .= $this->setFields();
		
		$this->query($sql, $this->bindings);
		
		$this->lastId = $this->connection()->lastInsertId();
		
		$this->reset();
		
		return $this;
	}
	
	/**
	* Atualizar dados no banco de dados 
	*
	* @param string $table
	* @return $this
	*/
	public function update($table = null)
	{
		if ($table)
		{
			$this->table($table);
		}
		
		$sql = 'UPDATE ' . $this->table . ' SET ';
		
		$sql .= $this->setFields();
		
		if ($this->wheres)
		{
			$sql .= ' WHERE ' . implode(' ' , $this->wheres);
		}
				
		$this->query($sql, $this->bindings);
		
		$this->reset();
		
		return $this;
	}
	
	/**
	* Clásula delete
	*
	* @param string $table
	* @return $this
	*/
	public function delete($table = null)
	{
		if ($table)
		{
			$this->table($table);
		}
		
		$sql = 'DELETE FROM ' . $this->table . ' ';
		
		if ($this->wheres)
		{
			$sql .= ' WHERE ' . implode(' ' , $this->wheres);
		}
				
		$this->query($sql, $this->bindings);
		
		$this->reset();
		
		return $this;
	}
	
	/**
	* Set the fields for insert and update
	*
	* @return string
	*/
	private function setFields()
	{	
		$sql = '';
		
		foreach (array_keys($this->data) as $key)
		{
			$sql .= '`' . $key . '` = ? , ';
		}
		
		$sql = rtrim($sql, ', ');
		
		return $sql;
	}
	
	/**
	* Adicionar nova cláusula where
	*
	* @return $this
	*/
	public function where()
	{
		$bindings = func_get_args();
		
		$sql = array_shift($bindings);
		
		$this->addToBindings($bindings);
		
		$this->wheres[] = $sql;
		
		return $this;
	}
	
	/**
	* Execute a instrução sql fornecida
	* 
	* @return \PDOStatement
	*/
	public function query()
	{
		$bindings = func_get_args();
		
		$sql = array_shift($bindings);
		
		if (count($bindings) == 1 AND is_array($bindings[0]))
		{
			$bindings = $bindings[0];
		}
		
		try
		{
			$query = $this->connection()->prepare($sql);
			
			foreach ($bindings as $key => $value)
			{
				$query->bindValue($key + 1, _e($value));
			}
			
			$query->execute();
					
			return $query;
		}
		catch (PDOException $e)
		{			
			die($e->getMessage());
		}
	}
	
	/**
	* Obter o último código de inserção
	*
	* @return int
	*/
	public function lastId()
	{
		return $this->lastId;
	}
	
	/**
	* Inclua o valor fornecido nas ligações
	*
	* @param mixed $value
	* @return void
	*/
	private function addToBindings($value)
	{
		if (is_array($value))
		{
			$this->bindings = array_merge($this->bindings, array_values($value));
		}
		else 
		{
			$this->bindings[] = $value;
		}
	}
	
	/**
	* Redefinir todos os dados
	*
	* @return void
	*/
	private function reset()
	{		
		$this->limit = null;
		
		$this->table = null;
		
		$this->offset = null;
		
		$this->data = [];
		
		$this->joins = [];
		
		$this->wheres = [];
		
		$this->orderBy = [];
		
		$this->selects = [];
		
		$this->bindings = [];
			
	}

}

























