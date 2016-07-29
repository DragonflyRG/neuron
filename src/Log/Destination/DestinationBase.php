<?php

/*
 *
 */

//////////////////////////////////////////////////////////////////////////////
//
// Abstract base class for the device level output destinations.
//
//////////////////////////////////////////////////////////////////////////////

namespace Neuron\Log\Destination;

use \Neuron\Log;
use \Neuron\Log\Format;

/**
 * Class DestinationBase
 * @package Neuron\Log\Destination
 */

abstract class DestinationBase
{
	private $_Format;

	/**
	 * @param $iLevel
	 * @return string
	 */

	public function getLevelText( $iLevel )
	{
		switch( $iLevel )
		{
			case Log\ILogger::DEBUG:
				return "Debug";

			case Log\ILogger::INFO:
				return "Info";

			case Log\ILogger::WARNING:
				return "Warning";

			case Log\ILogger::ERROR:
				return "Error";

			case Log\ILogger::FATAL:
				return "Fatal";

			default:
				return "Unknown";
		}
	}

	/**
	 * @param Format\IFormat $Format
	 */

	public function __construct( Format\IFormat $Format )
	{
		$this->setFormat( $Format );
	}

	/**
	 * @param Format\IFormat $Format
	 */

	public function setFormat( Format\IFormat $Format )
	{ $this->_Format = $Format; }

	/**
	 * @param $text
	 * @param Log\Data $Data
	 * @return mixed
	 */

	protected abstract function write( $text, Log\Data $Data );

	/**
	 * @param array $aParams
	 * @return mixed
	 */

	public abstract function open( array $aParams );

	/**
	 * @param $text
	 * @param $iLevel
	 */

	public function log( $text, $iLevel )
	{
		$Log = new Log\Data( time(), $text, $iLevel, $this->getLevelText( $iLevel ) );
		$text = $this->_Format->format( $Log );

		$this->write( $text, $Log );
	}
}
