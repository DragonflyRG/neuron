<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 9/4/15
 * Time: 11:58 AM
 */

namespace Neuron;


abstract class CommandLineApplicationBase
	extends ApplicationBase
{
	private $_aHandlers;

	protected function getHandlers()
	{
		return $this->_aHandlers;
	}

	/**
	 * @param $sSwitch
	 * @param $sDescription
	 * @param $method
	 * @param bool|false $bParam
	 */

	protected function addHandler( $sSwitch, $sDescription, $method, $bParam = false )
	{
		$this->_aHandlers[ $sSwitch ] = [
			'description'	=> $sDescription,
			'method'			=> $method,
			'param'			=> $bParam
		];
	}

	protected function processParameters()
	{
		for( $c = 0; $c < count( $this->getParameters() ); $c++ )
		{
			$sParam = $this->getParameters()[ $c ];

			foreach( $this->getHandlers() as $sSwitch => $aInfo )
			{
				if( $sSwitch == $sParam )
				{
					if( $aInfo[ 'param' ] )
					{
						$c++;
						$param = $this->getParameters()[ $c ];
						$this->$aInfo[ 'method' ]( $param );
					}
					else
					{
						$this->$aInfo[ 'method' ]();
					}
				}
			}
		}
	}

	protected function help()
	{
		echo get_class( $this )."\n";
		echo 'v'.$this->getVersion()."\n";

		foreach( $this->getHandlers() as $sSwitch => $aInfo )
		{
			echo "$sSwitch\t\t$aInfo[description]\n";
		}
	}

	protected function onStart()
	{
		$this->addHandler( '--help', 'Help', 'help' );

		if( !$this->isCommandLine() )
		{
			$this->log( "Application must be run from the command line.", Log\ILogger::FATAL );
			return false;
		}

		$this->processParameters();

		return parent::onStart();
	}
}