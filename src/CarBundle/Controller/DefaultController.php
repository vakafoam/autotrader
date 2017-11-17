<?php

namespace CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
    * @Route("/our-cars", name="offer")
    */
    public function indexAction(Request $request)
    {
        $carRepository = $this->getDoctrine()->getRepository('CarBundle:Car');
        // $cars = $carRepository->findAll();  // uses many DB queries - lazy loading
        $cars = $carRepository->findCarsWithDetails();

        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('search', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2])
                ]
            ])
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            die('Form submitted');
        }

        return $this->render('CarBundle:Default:index.html.twig',
            [
                'cars' => $cars,
                'form' => $form->createView()
            ]);
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
