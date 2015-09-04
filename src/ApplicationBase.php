<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 8/31/15
 * Time: 6:00 PM
 */

namespace Neuron;

use Neuron\Log;
use Neuron\Util;

/**
 * Class ApplicationBase
 * @package Neuron
 */

abstract class ApplicationBase
	implements Log\ILogger
{
	private $_Logger;
	protected $_aParameters;

	/**
	 * @return array
	 *
	 * returns all parameters
	 */

	protected function getParameters()
	{
		return $this->_aParameters;
	}

	/**
	 * @param $s
	 * @return mixed
	 */

	protected function getParameter( $s )
	{
		return $this->_aParameters[ $s ];
	}

	/**
	 * @return Log\Logger
	 */

	public function getLogger()
	{
		return $this->_Logger;
	}

	/**
	 * @param $s
	 * @param int $iLevel
	 *
	 * Writes to the log file. Defaults to debug mode.
	 * Data is only written to the log based on teh current run-level.
	 */

	public function log( $s, $iLevel = self::DEBUG )
	{
		$this->_Logger->log( get_class( $this ).': '.$s, $iLevel );
	}

	/**
	 * @return bool
	 */

	public function isCommandLine()
	{
		return Util\System::isCommandLine();
	}

	//
	//
	//

	public function __construct()
	{
		$Destination	= new Log\Destination\StdOut( new Log\Format\PlainText );
		$Logger 			= new Log\Logger( $Destination );

		$Logger->setRunLevel( $Logger::DEBUG );

		$this->_Logger = $Logger;
	}

	//
	// Application mechanics..
	//

	protected function onStart()
	{
		$this->log( 'Application started '.date( 'Y-m-d H:i:s' ), Log\ILogger::INFO );

		return true;
	}

	protected function onFinish()
	{
		$this->log( 'Application finished '.date( 'Y-m-d H:i:s' ), Log\ILogger::INFO );
	}

	/**
	 * @param \Exception $ex
	 * @return bool
	 */

	protected function onError( \Exception $ex )
	{
		$this->log( get_class( $ex ).', msg: '.$ex->getMessage(), Log\ILogger::ERROR );

		// Returning false skips executing onFinish.

		return true;
	}

	protected abstract function onRun();

	public abstract function getVersion();

	/**
	 * @param array|null $aArgv
	 */

	public function run( array $aArgv = null )
	{
		$this->_aParameters = $aArgv;

		if( !$this->onStart() )
		{
			$this->log( "onStart() returned false. Aborting.", Log\ILogger::FATAL );
			return;
		}

		try
		{
			$this->onRun();
		}
		catch( \Exception $Ex )
		{
			if( !$this->onError( $Ex ) )
				return;
		}

		$this->onFinish();
	}
}
