<?php

namespace BsBaseTest\Factory;

use PHPUnit_Framework_TestCase;
use BsBase\Factory\BaseControllerFactory;
/**
 * BaseControllerFactory test case.
 */
class BaseControllerFactoryTest extends PHPUnit_Framework_TestCase {
	
	/**
	 *
	 * @var BaseControllerFactory
	 */
	private $BaseControllerFactory;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated BaseControllerFactoryTest::setUp()

		$this->BaseControllerFactory = new BaseControllerFactory(/* parameters */);
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated BaseControllerFactoryTest::tearDown()
		$this->BaseControllerFactory = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests BaseControllerFactory->getReflection()
	 */
	public function testGetReflection() {
		// TODO Auto-generated BaseControllerFactoryTest->testGetReflection()
		$this->markTestIncomplete ( "getReflection test not implemented" );
		
		$this->BaseControllerFactory->getReflection(/* parameters */);
	}
	
	/**
	 * Tests BaseControllerFactory->attachDefaultServices()
	 */
	public function testAttachDefaultServices() {
		// TODO Auto-generated BaseControllerFactoryTest->testAttachDefaultServices()
		$this->markTestIncomplete ( "attachDefaultServices test not implemented" );
		
		$this->BaseControllerFactory->attachDefaultServices(/* parameters */);
	}
	
	/**
	 * Tests BaseControllerFactory->attachFormManager()
	 */
	public function testAttachFormManager() {
		// TODO Auto-generated BaseControllerFactoryTest->testAttachFormManager()
		$this->markTestIncomplete ( "attachFormManager test not implemented" );
		
		$this->BaseControllerFactory->attachFormManager(/* parameters */);
	}
	
	/**
	 * Tests BaseControllerFactory->attachDocumentManager()
	 */
	public function testAttachDocumentManager() {
		// TODO Auto-generated BaseControllerFactoryTest->testAttachDocumentManager()
		$this->markTestIncomplete ( "attachDocumentManager test not implemented" );
		
		$this->BaseControllerFactory->attachDocumentManager(/* parameters */);
	}
	
	/**
	 * Tests BaseControllerFactory->attachConfig()
	 */
	public function testAttachConfig() {
		// TODO Auto-generated BaseControllerFactoryTest->testAttachConfig()
		$this->markTestIncomplete ( "attachConfig test not implemented" );
		
		$this->BaseControllerFactory->attachConfig(/* parameters */);
	}
	
	/**
	 * Tests BaseControllerFactory->getController()
	 */
	public function testGetController() {
		// TODO Auto-generated BaseControllerFactoryTest->testGetController()
		$this->markTestIncomplete ( "getController test not implemented" );
		
		$this->BaseControllerFactory->getController(/* parameters */);
	}
	
	/**
	 * Tests BaseControllerFactory->getServiceManager()
	 */
	public function testGetServiceManager() {
		// TODO Auto-generated BaseControllerFactoryTest->testGetServiceManager()
		$this->markTestIncomplete ( "getServiceManager test not implemented" );
		
		$this->BaseControllerFactory->getServiceManager(/* parameters */);
	}
	
	/**
	 * Tests BaseControllerFactory->setServiceManager()
	 */
	public function testSetServiceManager() {
		// TODO Auto-generated BaseControllerFactoryTest->testSetServiceManager()
		$this->markTestIncomplete ( "setServiceManager test not implemented" );
		
		$this->BaseControllerFactory->setServiceManager(/* parameters */);
	}
}

