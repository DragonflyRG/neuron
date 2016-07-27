<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 7/27/16
 * Time: 6:43 PM
 */

namespace Neuron\Data\Validation;


class DateRange extends Date
{
	private $_sMinDate;
	private $_sMaxDate;

	protected function validate( $date )
	{
		if( !parent::validate( $date ) )
			return false;

		$start	= strtotime( $this->_sMinDate );
		$end		= strtotime( $this->_sMaxDate );
		$dt		= strtotime( $date );

		return ( ( $dt >= $start ) && ( $dt <= $end ) );
	}

	/**
	 * @param $sMin
	 * @param $sMax
	 */

	public function setRange( $sMin, $sMax )
	{
		$this->_sMinDate = $sMin;
		$this->_sMaxDate = $sMax;
	}
}
