<?php

namespace Neuron\Parser;

class CSV implements IParser
{
	public $_aResults;

	/**
	 * @param $sText
	 * @param array $aColumns
	 * @return array|bool
	 */

	public function parse( $sText, $aColumns = array() )
	{
		$aResults = array();

		$aData = str_getcsv( $sText );

		$idx = 0;

		foreach( $aColumns as $sColumn )
		{
			$aResults[ $sColumn ] = $aData[ $idx ];
			++$idx;
		}

		if( count( $aColumns ) != count( $aData ) )
		{
			$this->_aResults = $aResults;
			return false;
		}

		return $aResults;
	}
}

