<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 9/28/15
 * Time: 6:06 AM
 */

namespace Neuron\Data\Validation;

// todo: multivalidator

class MultiValidator
{
	private $_aAnds	= array();
	private $_aOrs		= array();

	public function __construct()
	{
		return $this;
	}

	public function _and()
	{}

	public function _or()
	{}
}
