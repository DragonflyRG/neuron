<?php

/*
 *
 */

//////////////////////////////////////////////////////////////////////////////
//
// Outputs to screen in html format.
//
//////////////////////////////////////////////////////////////////////////////

namespace Neuron\Log\Format;

use \Neuron\Log;

/**
 * Class HTML
 * @package Neuron\Log\Format
 */

class HTML
	implements IFormat
{
	public static function format( Log\Data $Data )
	{
		return '<small>'.date( "[Y-m-d G:i:s]", $Data->_TimeStamp )."</small> $Data->_sLevel $Data->_sText<br>";
	}
}
