<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 3/31/15
 * Time: 1:48 PM
 */

namespace Neuron\Data\Validation;


class IPAddress
	extends Validator
{
	protected function validate( $s )
	{
		return filter_var( $s, FILTER_VALIDATE_IP );
	}
}