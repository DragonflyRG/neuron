<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 8/18/15
 * Time: 4:44 PM
 */

namespace Neuron\Log\Format;

use \Neuron\Log;

/**
 * Interface IFormat
 * @package Neuron\Log\Format
 */

interface IFormat
{
	public static function format( Log\Data $data );
}