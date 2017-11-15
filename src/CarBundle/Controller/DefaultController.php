<?php

namespace CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
    * @Route("/our-cars", name="offer")
    */
    public function indexAction()
    {
        $carRepository = $this->getDoctrine()->getRepository('CarBundle:Car');
        // $cars = $carRepository->findAll();  // uses many DB queries - lazy loading
        $cars = $carRepository->findCarsWithDetails();

        return $this->render('CarBundle:Default:index.html.twig', ['cars' => $cars]);
    }

    /**
    *
    * @Route("/car/{id}", name="show_car")
    */
    public function showAction($id)
    {
        $carRepository = $this->getDoctrine()->getRepository('CarBundle:Car');
        // $car = $carRepository->find($id);  // uses many DB queries - lazy loading
        $car = $carRepository->findCarWithDetailsById($id);

        return $this->render('CarBundle:Default:show.html.twig', ['car' => $car]);
    }
}
