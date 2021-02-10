<?php 

namespace System;

use Closure;

/**
* Class Application
*
* @author Júlio César Cabral Valente
*/
class Application
{
	/**
	* Container
	*
	* @var array 
	*/
	private $container = [];
	
	/**
	* Objeto do aplicativo
	*
	* @var \System\Application
	*/
	private static $instance;
	
	/**
	* Construtor
	*
	* @param \System\File $file
	*/
	private function __construct(File $file)
	{
		$this->share('file', $file);
		
		$this->registerClasses();
		
		$this->loadHelpers();
	}
	
	/**
	* Obter Instância do aplicativo
	*
	* @param \System\File $file
	* @return \System\Application
	*/
	public static function getInstance($file = null)
	{
		if (is_null(static::$instance))
		{
			static::$instance = new static($file);
		}
		
		return static::$instance;
	} 
	
	/**
	* Execute o aplicativo
	*
	* @return void
	*/
	public function run()
	{
		$this->session->start();
		
		$this->request->prepareUrl();
		
		$this->file->requireFile('App/index.php');
		
		list($controller, $method, $arguments) = $this->route->getProperRoute();
		
		$output = (string) $this->load->action($controller, $method, $arguments);
		
		$this->response->setOutput($output);
		
		$this->response->send();
				
	}
	
	/**
	* Registrar classes no registro de carregamento automático spl
	*
	* @return void
	*/
	private function registerClasses()
	{
		spl_autoload_register([$this, 'load']);
	}
	
	/**
	* Carregar classe através do carregamento automático
	*
	* @param string $class
	* @return void
	*/
	public function load($class)
	{
		if (strpos($class, 'App') === 0)
		{
			$file = $class . '.php';
		}
		else 
		{
			// Obter a classe do diretório vendor
			$file = 'vendor/' . $class . '.php';			
		}
		
		if ($this->file->exists($file))
		{
			$this->file->requireFile($file);
		}
	}
	
	/**
	* Carregar arquivo de auxiliares
	* 
	* @return void
	*/
	private function loadHelpers()
	{
		$this->file->requireFile('vendor/helpers.php');
	}
	
	/**
	* Obter valor compartilhado
	* 
	* @param string $key
	* @return mixed
	*/
	public function get($key)
	{
		if (! $this->isSharing($key))
		{
			if ($this->isCoreAlias($key)) 
			{
				$this->share($key, $this->createNewCoreObject($key));
			}
			else 
			{
				die('<b>' . $key . '</b> Não encontrada no container da aplicação');
			}
		}
		
		return $this->container[$key];
	}
	
	/**
	* Determinar se a chave fornecida é compartilhada através do aplicativo
	* 
	* @param string $key
	* @return bool
	*/
	public function isSharing($key)
	{
		return isset($this->container[$key]);
	}
	
	/**
	* Compartilhe o valor da chave fornecida através do aplicativo
	*
	* @param string $key
	* @param mixed $value
	* @return mixed
	*/
	public function share($key, $value)
	{
		if ($value instanceof Closure)
		{
			$value = call_user_func($value, $this);
		}
		$this->container[$key] = $value;
	}
	
	/**
	* Determinar se a chave fornecida é um alias para a classe principal
	* 
	* @param string $alias
	* @return bool
	*/
	private function isCoreAlias($alias)
	{
		$coreClasses = $this->coreClasses();
		
		return isset($coreClasses[$alias]);
	}
	
	/**
	* Crie um novo objeto para a classe principal com base no alias fornecido
	* 
	* @param string $alias
	* @return object
	*/
	private function createNewCoreObject($alias)
	{
		$coreClasses = $this->coreClasses();
		
		$object = $coreClasses[$alias];
		
		return new $object($this);
	}
	
	/**
	* Obter todas as classes principais com seus aliases
	* 
	* @return array
	*/
	public function coreClasses()
	{
		return [
		
			'request'   => 'System\\Http\\Request', 
			'response'  => 'System\\Http\\Response', 
			'session'   => 'System\\Session',
			'route'     => 'System\\Route',
			'cookie'    => 'System\\Cookie', 
			'load'      => 'System\\Loader',
			'html'      => 'System\\Html',
			'db'        => 'System\\Database',
			'view'      => 'System\\View\\ViewFactory',
			'url'       => 'System\\Url',
			'validator' => 'System\\Validation',
		];
	}
	
	/**
	* Obtenha valor compartilhado dinamicamente
	* 
	* @param string $key
	* @return mixed
	*/
	public function __get($key)
	{
		return $this->get($key);
	}
	
}


