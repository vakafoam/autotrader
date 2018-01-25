<?php
/**
 * Created by PhpStorm.
 * User: vaka
 * Date: 1/25/2018
 * Time: 1:46 PM
 */

namespace AppBundle\DataFixtures;

use CarBundle\Entity\Make;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDictionary implements ORMFixtureInterface
{

    /**s
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $make = new Make();
        $make->setName('VW');

        $make1 = new Make();
        $make1->setName('BMW');

        $make2 = new Make();
        $make2->setName('Fiat');

        $manager->persist($make);
        $manager->persist($make1);
        $manager->persist($make2);
        $manager->flush();

    }
}