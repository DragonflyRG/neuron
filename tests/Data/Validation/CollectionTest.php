<?php

class CollectionTest extends PHPUnit_Framework_TestCase
{
	public $Collection;

	public function setUp()
	{
		parent::setUp();

		$this->Collection = new \Neuron\Data\Validation\Collection();

		$this->Collection->add( 'Positive', new \Neuron\Data\Validation\Positive() );
		$this->Collection->add( 'Int', new \Neuron\Data\Validation\Integer() );

	}

	public function testFail()
	{
		$this->assertFalse( $this->Collection->isValid( -1 ) );
	}

	public function testFailList()
	{
		$this->Collection->isValid( 1.00 );

		$this->assertTrue(
			\Neuron\Data\ArrayHelper::contains( $this->Collection->getFailedList(), 'Int' )
		);

		$this->Collection->isValid( -1 );

		$this->assertTrue(
			\Neuron\Data\ArrayHelper::contains( $this->Collection->getFailedList(),'Positive' )
		);

		$this->Collection->isValid( -1.01 );

		$this->assertTrue(
			\Neuron\Data\ArrayHelper::contains( $this->Collection->getFailedList(),'Positive' )
		);

		$this->assertTrue(
			\Neuron\Data\ArrayHelper::contains( $this->Collection->getFailedList(),'Int' )
		);

	}


	public function testPass()
	{
		$this->assertTrue( $this->Collection->isValid( 1 ) );
	}
}