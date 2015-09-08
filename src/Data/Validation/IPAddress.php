<?php


namespace Neuron\Data\Validation;

/**
 * IPAddress validation.
 */

class IPAddress
	extends ValidatorBase
{
	protected function validate( $s )
	{
		return filter_var( $s, FILTER_VALIDATE_IP )? true : false;
	}
}