<?php 

namespace System\View;

/**
* Interface ViewInterface
*
* @author Júlio César Cabral Valente
*/
interface ViewInterface
{
	/**
	* Obter a saída da visualização
	*
	* @return string
	*/
	public function getOutput();
	
	/**
	* Converter o objeto de exibição em string na impressão
	*
	* i.e echo $object
	* @return string
	*/
	
	public function __toString();
}
