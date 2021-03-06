<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2017-2018
 */


namespace Aimeos\Controller\Jobs\Media\Scale;


class StandardTest extends \PHPUnit\Framework\TestCase
{
	private $object;


	protected function setUp()
	{
		$context = \TestHelperJobs::getContext();
		$aimeos = \TestHelperJobs::getAimeos();

		$this->object = new \Aimeos\Controller\Jobs\Media\Scale\Standard( $context, $aimeos );
	}


	protected function tearDown()
	{
		$this->object = null;
	}


	public function testGetName()
	{
		$this->assertEquals( 'Rescale product images', $this->object->getName() );
	}


	public function testGetDescription()
	{
		$text = 'Rescales product images to the new sizes';
		$this->assertEquals( $text, $this->object->getDescription() );
	}


	public function testRun()
	{
		$context = \TestHelperJobs::getContext();
		$aimeos = \TestHelperJobs::getAimeos();


		$fsmStub = $this->getMockBuilder( '\\Aimeos\\MW\\FileSystem\\Manager\\Standard' )
			->disableOriginalConstructor()
			->setMethods( ['get'] )
			->getMock();

		$fsStub = $this->getMockBuilder( '\\Aimeos\\MW\\FileSystem\\Standard' )
			->disableOriginalConstructor()
			->setMethods( ['time'] )
			->getMock();

		$fsmStub->expects( $this->once() )->method( 'get' )->will( $this->returnValue( $fsStub ) );
		$fsStub->expects( $this->atLeast( 1 ) )->method( 'time' )->will( $this->returnValue( 0 ) );
		$context->setFileSystemManager( $fsmStub );

		$name = 'ControllerJobsMediaScaleStandardRun';
		$context->getConfig()->set( 'mshop/media/manager/name', $name );
		$context->getConfig()->set( 'controller/common/media/name', $name );


		$managerStub = $this->getMockBuilder( '\\Aimeos\\MShop\\Media\\Manager\\Standard' )
			->setMethods( array( 'saveItem' ) )
			->setConstructorArgs( array( $context ) )
			->getMock();

		\Aimeos\MShop\Media\Manager\Factory::injectManager( '\\Aimeos\\MShop\\Media\\Manager\\' . $name, $managerStub );

		$managerStub->expects( $this->atLeast( 1 ) )->method( 'saveItem' );


		$cntlStub = $this->getMockBuilder( '\\Aimeos\\Controller\\Common\\Media\\Standard' )
			->setMethods( array( 'scale' ) )
			->setConstructorArgs( array( $context ) )
			->getMock();

		\Aimeos\Controller\Common\Media\Factory::inject( '\\Aimeos\\Controller\\Common\\Media\\' . $name, $cntlStub );

		$cntlStub->expects( $this->atLeast( 1 ) )->method( 'scale' )->will( $this->returnArgument( 0 ) );


		$object = new \Aimeos\Controller\Jobs\Media\Scale\Standard( $context, $aimeos );
		$object->run();
	}
}
