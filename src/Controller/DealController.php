<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Deal;
use App\Entity\Vote;
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
     * @Route("/deals/{id}/degree/{degree}", options={"expose"= true}, name="app_degree")
     * @param int $id
     * @param int $degree
     */
    public function doDegree(int $id, int $degree)
    {
        $testVote = $this->getDoctrine()
            ->getRepository(Vote::class)
            ->findBy(array("user"=>$this->getUser(), "deal"=>$id));

        if ($testVote != null){
            return new Response("Le user a deja voté",Response::HTTP_UNAUTHORIZED);
        }

        $deal =  $this->getDoctrine()->getRepository(Deal::class)->find($id);
        $deal->setDegree($deal->getDegree() + $degree);

        $vote = new Vote();
        $vote->setDeal($deal);
        $vote->setNotation($degree);
        $vote->setUser($this->getUser());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($deal);
        $entityManager->persist($vote);
        $entityManager->flush();

        return $this->json(['id' => $deal->getId(), 'degree' => $deal->getDegree()],Response::HTTP_CREATED);
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

    /**
     * @Route("/deals/{id}/save", name="app_saveDeal")
     * @param Deal $deal
     */
    public function saveDeal(Deal $deal)
    {
        $user = $this->getUser();
        $user->addDealsSaved($deal);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($deal);
        $manager->flush();
        return $this->json(['id' => $deal->getId()],Response::HTTP_CREATED);
    }

}
