<?php

namespace App\Controller\Admin;

use App\Entity\Refund;
use App\Form\Refund1Type;
use App\Form\RefundType;
use App\Repository\RefundRepository;
use DateTime;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/refund")
 */
class RefundController extends AbstractController
{
    /**
     * @Route("/{slug}", name="refund_index", methods={"GET"})
     */
    public function index(RefundRepository $refundRepository, $slug): Response
    {
        $refund = new Refund();
        date_default_timezone_set('Europe/Istanbul');
        $refunds = $refundRepository->getByStatus($slug);
        $tarih = $refundRepository->getCreatedTime();

        for ($deger = 0; $deger < count($tarih); $deger++) {
            $date = new DateTime($tarih[$deger]["created_at"]);
            $now = new DateTime();

            $date = date_diff($now, $date);


            $realdate[$deger] = $date->format('%d Day %h Hours');

        }

        return $this->render('refund/index.html.twig', [
            'refunds' => $refunds,
            'remain' => $realdate,
        ]);
    }

//    /**
//     * @Route("/new", name="refund_new", methods={"GET","POST"})
//     */
//    public function new(Request $request): Response
//    {
//        $refund = new Refund();
//        $form = $this->createForm(RefundType::class, $refund);
//        $form->handleRequest($request);
//
//
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($refund);
//            $entityManager->flush();
//
//            $this->addFlash(
//                'success',
//                'Your changes were saved!'
//            );
//
//            return $this->redirectToRoute('refund_new');
//        }
//
//        return $this->render('refund/new.html.twig', [
//            'refund' => $refund,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{id}", name="refund_show", methods={"GET"})
     */
    public function show(Refund $refund): Response
    {


        return $this->render('refund/show.html.twig', [
            'refund' => $refund,

        ]);
    }

    /**
     * @Route("/{id}/edit", name="refund_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Refund $refund): Response
    {
        $form = $this->createForm(Refund1Type::class, $refund);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $status = $form['status']->getData();

            return $this->redirectToRoute('refund_index', ['slug' => $status]);
        }

        return $this->render('refund/edit.html.twig', [
            'refund' => $refund,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="refund_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Refund $refund): Response
    {
        if ($this->isCsrfTokenValid('delete'.$refund->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($refund);
            $entityManager->flush();
        }

        return $this->redirectToRoute('refund_index');
    }
}
