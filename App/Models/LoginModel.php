<?php

namespace App\Models;

use System\Model;

/**
* Class LoginModel
*
* @author Júlio César Cabral Valente
*/
class LoginModel extends Model
{
	/**
	* Nome da tabela no banco de dados
	*
	* @var string
	*/
	protected $table = 'usuario';
	
	private $user;
	
	/**
	* Determinar se os dados de login fornecidos são válidos
	*
	* @var string
	*/
	public function isValidLogin($user, $password)
	{
		// $user = $this->where('usuario=?', $user)->fetch($this->table);

		$user = $this->select('t1.id_pessoa', 't2.nome', 't3.foto', 't4.usuario', 't4.senha', 't4.codigo')
					 ->from('pessoa t1')
					 ->join('INNER JOIN pessoa_fisica t2 on t1.id_pessoa = t2.id_pessoa_fisica')
					 ->join('LEFT JOIN pessoa_foto t3 on t1.id_pessoa = t3.id_pessoa_foto')
					 ->join('LEFT JOIN usuario t4 on t1.id_pessoa = t4.id_pessoa_usuario')
					 ->where('t4.usuario=?', $user)
					 ->fetch();

		if (! $user)
		{
			return false;
		}
		
		$this->user = $user;
		
		return password_verify($password, $user->senha);
	}
	
	/**
	* Obter dados do usuário logado
	*
	* @return \stdClass
	*/
	public function user()
	{
		return $this->user;
	}
	
	/**
	* Determinar se o usuário está logado
	*
	* @return bool
	*/
	public function isLogged()
	{
		if ($this->cookie->has('login'))
		{
			$code = $this->cookie->get('login');
		}
		elseif ($this->session->has('login'))
		{
			$code = $this->session->get('login');
		}
		else
		{
			$code = '';
		}
		
		// $user = $this->where('codigo=?', $code)->fetch($this->table);

		$user = $this->select('t1.id_pessoa', 't2.nome', 't3.foto', 't4.usuario', 't4.senha', 't4.codigo')
			         ->from('pessoa t1')
			         ->join('INNER JOIN pessoa_fisica t2 on t1.id_pessoa = t2.id_pessoa_fisica')
			         ->join('LEFT JOIN pessoa_foto t3 on t1.id_pessoa = t3.id_pessoa_foto')
			         ->join('LEFT JOIN usuario t4 on t1.id_pessoa = t4.id_pessoa_usuario')
			         ->where('t4.codigo=?', $code)
			         ->fetch();

		if (! $user)
		{
			return false;
		}
		
		$this->user = $user;
		
		return true;
	
	}
	
}















