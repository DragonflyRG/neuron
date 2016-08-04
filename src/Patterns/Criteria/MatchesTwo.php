<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 8/4/16
 * Time: 2:29 PM
 */

namespace Neuron\Patterns\Criteria;

class MatchesTwo extends Base implements ICriteria
{
	public function meetCriteria( array $entities )
	{
		$aResults = [];

		foreach( $entities as $item )
		{
			if( $item[ 'name' ] == 'one' )
			{
				$aResults[] = $item;
			}
		}

		return $aResults;
	}
}
