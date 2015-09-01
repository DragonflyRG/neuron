<?php

/*
 *
 */

//////////////////////////////////////////////////////////////////////////////
//
// Encapsulation class for the log information passed to destinations.
//
//////////////////////////////////////////////////////////////////////////////

namespace Neuron\Log;

class Data
{
	public $_TimeStamp;
	public $_sText;
	public $_iLevel;
	public $_sLevel;

	public function __construct( $TimeStamp, $sText, $iLevel, $sLevel )
	{
		$this->_TimeStamp	= $TimeStamp;
		$this->_sText		= $sText;
		$this->_iLevel		= $iLevel;
		$this->_sLevel		= $sLevel;
	}
};


?>
