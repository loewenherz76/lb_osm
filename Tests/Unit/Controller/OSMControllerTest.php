<?php
namespace LeonhardBolschakow\LbOsm\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Leonhard Bolschakow <leonhard@bolschakow.de>, Leonhard Bolschakow
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class LeonhardBolschakow\LbOsm\Controller\OSMController.
 *
 * @author Leonhard Bolschakow <leonhard@bolschakow.de>
 */
class OSMControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \LeonhardBolschakow\LbOsm\Controller\OSMController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('LeonhardBolschakow\\LbOsm\\Controller\\OSMController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllOSMsFromRepositoryAndAssignsThemToView()
	{

		$allOSMs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$oSMRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$oSMRepository->expects($this->once())->method('findAll')->will($this->returnValue($allOSMs));
		$this->inject($this->subject, 'oSMRepository', $oSMRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('oSMs', $allOSMs);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenOSMToView()
	{
		$oSM = new \LeonhardBolschakow\LbOsm\Domain\Model\OSM();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('oSM', $oSM);

		$this->subject->showAction($oSM);
	}
}
