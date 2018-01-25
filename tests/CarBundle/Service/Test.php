<?php
/**
 * Created by PhpStorm.
 * User: vaka
 * Date: 1/25/2018
 * Time: 11:57 AM
 */

namespace CarBundle\Service;

use Doctrine\ORM\EntityManager;

class DataCheckerTest extends \PHPUnit_Framework_TestCase
{
    /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject */
    protected $entityManager;

    public function setUp()
    {
        $this->entityManager = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->disableArgumentCloning()
            ->getMock();
    }

    public function testCheckCarRequirePhotosReturnFalse()
    {
        $subject = new DataChecker($this->entityManager, true);
        $expectedResult = false;

        $car = $this->getMock('CarBundle\Entity\Car');
        $car->expects($this->once())
            ->method('setPromoted')
            ->with($expectedResult);

        $this->entityManager->expects($this->once())
            ->method('persist')
            ->with($car);
        $this->entityManager->expects($this->once())
            ->method('flush');

        $result = $subject->checkCar($car);
        $this->assertEquals($expectedResult, $result);
    }


}
