<?php

use Neuron\Data\Object\DateRange;
use PHPUnit\Framework\TestCase;

class DateRangeObjectTest extends TestCase
{
	public function testGetLengthInDays()
	{
		$Range = new DateRange(
			date( 'Y-m-d' ),
			date( 'Y-m-d', strtotime( "+7 days" ) )
		);

		$this->assertEquals(
			7,
			$Range->getLengthInDays()
		);

		$this->assertNotEquals(
			8,
			$Range->getLengthInDays()
		);

	}
}
