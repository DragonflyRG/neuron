<?php

class RegistrylTest extends PHPUnit_Framework_TestCase
{
	protected function setUp()
	{
	}

	public function testPass()
	{
		$Reg1 = Neuron\Registry::getInstance();

		$Reg1->set( 'test', '1234' );

		$Reg2 = Neuron\Registry::getInstance();

		$this->assertEquals( $Reg2->get( 'test' ), '1234' );
	}

	public function testFail()
	{
		$Reg1 = Neuron\Registry::getInstance();

		$Reg1->set( 'test', '1234' );

		$Reg2 = Neuron\Registry::getInstance();

		$this->assertNotEquals( $Reg2->get( 'test' ), '1111' );
	}

	protected function tearDown()
	{
	}
}
