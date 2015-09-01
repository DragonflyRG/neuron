<?php

namespace Neuron\Parser;

class Positional
	implements IParser
{
   public function parse( $sText, $aLocations = array() )
   {
      $aResults = array();

      foreach( $aLocations as $aPos )
      {
         $aResults[ $aPos[ 'name' ] ] = trim( substr( $sText, $aPos[ 'start' ], $aPos[ 'length' ] ) );
      }

      return $aResults;
   }
}

