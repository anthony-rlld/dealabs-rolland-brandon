<?php

namespace App\Controller;

use App\Entity\Deal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DealController extends AbstractController
{
    /**
     * @Route("/deals/{id}", name="app_dealdetail")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function index(Request $request, int $id): Response
    {
        $deal =  $this->getDoctrine()->getRepository(Deal::class)->find($id);

        return $this->render('detail/detailDealPage.html.twig', [
            'controller_name' => 'DealController',
            'deal' => $deal
        ]);
    }

    /**
     * @Route("/deals/degree/{id}/{degree}", name="app_degree")
     * @param Request $request
     * @param int $id
     * @param int $degree
     */
    public function doDegree(Request $request,int $id, int $degree)
    {
        $deal =  $this->getDoctrine()->getRepository(Deal::class)->find($id);

        $deal->setDegree($deal->getDegree() + $degree);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($deal);
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }
}
