<?php

namespace Neuron\Util;

class Template 
{
	/**
	 * @param $file
	 * @param $fields
	 * @return mixed
	 */

	static function fromFile( $file, $fields )
	{
		$file = "templates/$file";

		if( file_exists( $file ) )
			$text = @file_get_contents( $file );
		else
			die( "Template not found: $file." );

		return self::fromText( $text, $fields );
	}

	/**
	 * @param $text
	 * @param $fields
	 * @return mixed
	 */

	static function fromText( $text, $fields )
	{
		foreach( $fields as $field => $data )
		{
			$find = '%'.$field.'%';

			$text = str_replace( $find, $data, $text );
		}

		return $text;
	}
}
