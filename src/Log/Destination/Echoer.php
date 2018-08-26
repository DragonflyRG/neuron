<?php

namespace Neuron\Log\Destination;

use Neuron\Log;

/**
 * Outputs information using the php echo command. (non stdout)
 */

class Echoer extends DestinationBase
{
	/**
	 * @param array $Params
	 * @return bool
	 *
	 * @SuppressWarnings(PHPMD)
	 */

	public function open( array $Params )
	{
		return true;
	}

	public function close()
	{}

	/**
	 * @param $text
	 * @param Log\Data $Data
	 * @return void
	 *
	 * @SuppressWarnings(PHPMD)
	 */

	public function write( $text, Log\Data $Data )
	{
		echo $text."\r\n";
	}
}
