<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 8/18/15
 * Time: 5:26 PM
 */

namespace Neuron\Log\Destination;

use \Neuron\Log;

class StdOut
	extends DestinationBase
{
	public function open( array $aParams )
	{ return true; }

	public function close()
	{}

	public function write( $s, Log\Data $Data )
	{
		fwrite( STDOUT, $s."\r\n" );
	}
}