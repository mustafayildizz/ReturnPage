<?php

namespace App\Controller;

use App\Entity\Refund;
use App\Form\RefundType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
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
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function new(Request $request,  \Swift_Mailer $mailer): Response
    {
        $refund = new Refund();
        $form = $this->createForm(RefundType::class, $refund);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $refund->setCreatedAt(new \DateTime());
            $refund->setStatus('New');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($refund);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('karabuktest@gmail.com')
                ->setTo($form['email']->getData())
                ->setBody(
                    'Here is the message itself'
                );

            $mailer->send($message);
            return $this->redirectToRoute('home_refund_new');
        }

        return $this->render('refund/new.html.twig', [
            'refund' => $refund,
            'form' => $form->createView(),
        ]);
    }


}
