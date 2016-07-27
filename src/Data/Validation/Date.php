<?php

namespace Neuron\Data\Validation;

/**
 * Date validation.
 */

class Date extends ValidatorBase
{
	private $_sFormat = 'Y-m-d';

	protected function validate( $date )
	{
		$d = \DateTime::createFromFormat( $this->_sFormat, $date );
		return $d && $d->format( $this->_sFormat ) == $date;
	}

	/**
	 * @param $sFormat Specify the date format to validate to. Defaults to Y-m-d
	 */

	public function setFormat( $sFormat )
	{
		$this->_sFormat = $sFormat;
	}
}
