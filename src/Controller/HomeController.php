<?php

namespace App\Controller;

use App\Entity\Refund;
use App\Form\RefundType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/refund", name="home_refund_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $refund = new Refund();
        $form = $this->createForm(RefundType::class, $refund);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($refund);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('home_refund_new');
        }

        return $this->render('refund/new.html.twig', [
            'refund' => $refund,
            'form' => $form->createView(),
        ]);
    }


}
