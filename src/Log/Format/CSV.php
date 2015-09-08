<?php

namespace Neuron\Log\Format;

use Neuron\Log;

/**
 * Formats log data into a CSV format.
 */

class CSV
	implements IFormat
{
	public static function format( Log\Data $Data )
	{
		return date( "[Y-m-d G:i:s]", $Data->_TimeStamp ) . ",$Data->_sLevel,$Data->_sText";
	}
}

