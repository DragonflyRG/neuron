<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 3/31/15
 * Time: 1:48 PM
 */

namespace Neuron\Data\Validation;

/**
 * Class Integer
 * @package Neuron\Data\Validation
 */

class Integer
	extends ValidatorBase
{
	protected function validate( $i )
	{
		if( is_int( $i ) )
			return true;

		return ctype_digit( $i );
	}
}