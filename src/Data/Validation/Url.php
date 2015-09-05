<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 3/31/15
 * Time: 1:48 PM
 */

namespace Neuron\Data\Validation;

/**
 * Class Url
 * @package Neuron\Data\Validation
 */

class Url
	extends ValidatorBase
{
	protected function validate( $s )
	{
		return filter_var( $s, FILTER_VALIDATE_URL ) ? true : false;
	}
}