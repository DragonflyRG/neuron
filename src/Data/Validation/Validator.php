<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 3/31/15
 * Time: 1:44 PM
 */

namespace Neuron\Data\Validation;

/**
 * Class Validator
 * @package Neuron\Data\Validation
 */

abstract class Validator
{

	abstract protected function validate( $data );

	public function __construct()
	{}

	public function isValid( $data )
	{
		return $this->validate( $data );
	}
}