<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Deal;
use App\Form\CommentFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
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
        $comments = $deal->getCommentsList();

        $form = $this->createCommentForm($request, $deal);

        return $this->render('detail/detailDealPage.html.twig', [
            'controller_name' => 'DealController',
            'deal' => $deal,
            'comments' => $comments,
            'form' => $form->createView()
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

    private function createCommentForm(Request $request, Deal $deal): FormInterface
    {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setUser($this->getUser());
            $comment->setDeal($deal);
            $comment->setCreationDate(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
        }

        return $form;
    }

}
