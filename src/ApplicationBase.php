<?php

namespace Neuron;

use Neuron\Log;
use Neuron\Util;

/**
 * Defines base functionality for applications.
 */


abstract class ApplicationBase extends Log\LoggableBase
	implements IApplication
{
	private		$_Logger;
	protected	$_aParameters;
	protected	$_aSettings;

	public function getSetting( $sName, $sSection = 'default' )
	{
		return $this->_aSettings[ $sSection ][ $sName ];
	}

	public function setSetting( $sName, $sValue, $sSection = 'default' )
	{
		$this->_aSettings[ $sSection ][ $sName ] = $sValue;
	}

	/**
	 * @return array
	 *
	 * returns parameters passed to the run method.
	 */

	protected function getParameters()
	{
		return $this->_aParameters;
	}

	/**
	 * @param $s
	 * @return mixed
	 */

	public function getParameter( $s )
	{
		return $this->_aParameters[ $s ];
	}

	/**
	 * @return Log\LogMux
	 */

	public function getLogger()
	{
		return $this->_Logger;
	}

	/**
	 * @param $s
	 * @param int $iLevel
	 *
	 * Writes to the logger. Defaults to debug level.
	 * Data is only written to the log based on the loggers run-level.
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

	/**
	 *  Creates and configures the default logger.
	 */

	public function __construct()
	{
		$Destination	= new Log\Destination\StdOut( new Log\Format\PlainText );
		$Log 				= new Log\Logger( $Destination );

		$this->_Logger = new Log\LogMux();
		$this->_Logger->addLog( $Log );

		$this->_Logger->setRunLevel( Log\ILogger::INFO );

		parent::__construct( $this->_Logger );
	}

	/**
	 * @return bool
	 *
	 * Called before onRun. If false is returned, application terminates
	 * without executing onRun.
	 */

	protected function onStart()
	{
		$this->log( 'Application started '.date( 'Y-m-d H:i:s' ), Log\ILogger::INFO );

		return true;
	}

	/**
	 * Called immediately after onRun.
	 */

	protected function onFinish()
	{
		$this->log( 'Application finished '.date( 'Y-m-d H:i:s' ), Log\ILogger::INFO );
	}

	/**
	 * @param \Exception $ex
	 * @return bool
	 * Called for any unhandled exceptions.
	 */

	protected function onError( \Exception $ex )
	{
		$this->log( get_class( $ex ).', msg: '.$ex->getMessage(), Log\ILogger::ERROR );

		// Returning false skips executing onFinish.

		return true;
	}

	/**
	 * @return mixed
	 * Must be implemented by derived classes.
	 */

	protected abstract function onRun();

	/**
	 * @return string
	 * Application version number.
	 * Must be implemented by derived classes.
	 */

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
