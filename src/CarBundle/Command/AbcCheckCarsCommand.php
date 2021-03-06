<?php

namespace CarBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Doctrine\ORM\EntityManager;
use CarBundle\Service\DataChecker;

class AbcCheckCarsCommand extends Command
{
    /** @var DataChecker */
    protected $carChecker;
    /** @var EntityManager */
    protected $manager;

    /** Constructor
    * @param DataChecker $carChecker
    * @param EntityManager $manager
    */
    public function __construct(DataChecker $carChecker, EntityManager $manager)
    {
      $this->carChecker = $carChecker;
      $this->manager = $manager;
      parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('abc:check-cars')
            ->setDescription('...')
            ->addArgument('format', InputArgument::OPTIONAL, 'Progress format')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $carRepository = $this->manager->getRepository('CarBundle:Car');
        $cars = $carRepository->findAll();
        $bar = new ProgressBar($output, count($cars));
        $bar->start();

        // Optional command argument
        $argument = $input->getArgument('format');
        $bar->setFormat($argument);

        foreach ($cars as $car) {
          $this->carChecker->checkCar($car);
          $bar->advance();
        }

        $bar->finish();
    }

}
