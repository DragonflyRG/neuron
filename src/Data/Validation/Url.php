<?php

namespace Neuron\Data\Validation;

/**
 * Url validation.
 */

class Url
	extends ValidatorBase
{
	protected function validate( $s )
	{
		return filter_var( $s, FILTER_VALIDATE_URL ) ? true : false;
	}
}