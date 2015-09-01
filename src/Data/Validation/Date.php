<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 3/31/15
 * Time: 1:48 PM
 */

namespace Neuron\Data\Validation;

class Date
	extends Validator
{
	private $_sFormat = 'Y-m-d';

	protected function validate( $date )
	{
		$d = \DateTime::createFromFormat( $this->_sFormat, $date );
		return $d && $d->format( $this->_sFormat ) == $date;
	}

	public function setFormat( $sFormat )
	{
		$this->_sFormat = $sFormat;
	}
}