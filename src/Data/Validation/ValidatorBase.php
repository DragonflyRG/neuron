<?php

namespace Neuron\Data\Validation;

/**
 * Validator base class.
 */

abstract class ValidatorBase implements IValidator
{
	abstract protected function validate( $data );

	public function __construct()
	{
		return $this;
	}

	/**
	 * Returns true if validation is successful
	 *
	 * @param $data
	 * @return bool
	 */

	public function isValid( $data )
	{
		return $this->validate( $data );
	}
}
