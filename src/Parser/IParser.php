<?php

namespace Neuron\Parser;

interface IParser
{
	public function parse( $sText, $UserData = array() );
}