<?php

namespace App\Controller;

use App\Entity\GoodDeal;
use App\Form\GoodDealFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GoodDealController extends AbstractController
{
    /**
     * @Route("/gooddeal", name="godddeal")
     */
    public function index(): Response
    {
        return $this->render('deal/goodDeal.html.twig', [
            'controller_name' => 'GoodDealController',
        ]);
    }

    /**
     * @Route("/gooddeals/add",name="addgooddeal")
     * @param Request $request
     * @return Response
     */
    public function addGoodDeal(Request $request): Response
    {
        $goodDeal = new GoodDeal();

        $form = $this->createForm(GoodDealFormType::class, $goodDeal);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $goodDeal = $form->getData();

          //  $goodDealRepo = $this->getDoctrine()->getRepository(GoodDeal::class);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($goodDeal);
            $entityManager->flush();

            return $this->redirectToRoute('home');

        }
        return $this->render('/deal/goodDeal.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
