<?php

namespace Neuron;

use Neuron\Setting;
use Neuron\Log;
use Neuron\Util;

/**
 * Defines base functionality for applications.
 */

abstract class ApplicationBase extends Log\LoggableBase implements IApplication
{
	private		$_Logger;
	private		$_Registry;
	protected	$_aParameters;
	protected	$_Settings;

	/**
	 * @param Setting\Source\ISettingSource $Source
	 * @return $this
	 */

	public function setConfig( Setting\Source\ISettingSource $Source )
	{
		$this->_Settings = new Setting\SettingManager( $Source );
		return $this;
	}

	/**
	 * @param $sName
	 * @param string $sSection
	 * @return mixed
	 */

	public function getSetting( $sName, $sSection = 'default' )
	{
		return $this->_Settings->get( $sSection, $sName );
	}

	/**
	 * @param $sName
	 * @param $sValue
	 * @param string $sSection
	 */

	public function setSetting( $sName, $sValue, $sSection = 'default' )
	{
		$this->_Settings->set( $sSection, $sName, $sValue );
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
		$this->_Registry = Registry::getInstance();

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
		return true;
	}

	/**
	 * Called immediately after onRun.
	 */

	protected function onFinish()
	{
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
	 * @return bool
	 */

	public function run( array $aArgv = null )
	{
		$this->_aParameters = $aArgv;

		if( !$this->onStart() )
		{
			$this->log( "onStart() returned false. Aborting.", Log\ILogger::FATAL );
			return false;
		}

		try
		{
			$this->onRun();
		}
		catch( \Exception $Ex )
		{
			if( !$this->onError( $Ex ) )
			{
				return false;
			}
		}

		$this->onFinish();
		return true;
	}

	//region Parameters
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
	//endregion

	//region Logging
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
	//endregion

	//region Registry

	/**
	 * @param $name
	 * @param $object
	 */

	public function setRegistryObject( $name, $object )
	{
		$this->_Registry->set( $name, $object );
	}

	/**
	 * @param $name
	 * @return mixed
	 */

	public function getRegistryObject( $name )
	{
		return $this->_Registry->get( $name );
	}
	//endregion
}
