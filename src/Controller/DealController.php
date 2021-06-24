<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Deal;
use App\Entity\Vote;
use App\Events;
use App\Form\CommentFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface as EventDispatcher;
use Symfony\Component\EventDispatcher\GenericEvent;
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
    public function index(Request $request, int $id, EventDispatcher $eventDispatcher): Response
    {
        $deal =  $this->getDoctrine()->getRepository(Deal::class)->find($id);
        $comments = $deal->getCommentsList();

        $form = $this->createCommentForm($request, $deal, $eventDispatcher);

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
     * @param EventDispatcher $eventDispatcher
     */
    public function doDegree(int $id, int $degree, EventDispatcher $eventDispatcher)
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

        $event = new GenericEvent($this->getUser(), ["Manager"=>$entityManager]);
        $eventDispatcher->dispatch( $event, Events::VALIDATED_SUPERVISOR_BADGE);

        return $this->json(['id' => $deal->getId(), 'degree' => $deal->getDegree()],Response::HTTP_CREATED);
    }

    private function createCommentForm(Request $request, Deal $deal,
                                       EventDispatcher $eventDispatcher): FormInterface
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

            $event = new GenericEvent($this->getUser(), ["Manager"=>$entityManager]);
            $eventDispatcher->dispatch( $event, Events::VALIDATED_REPORT_BADGE);

            $entityManager->persist($comment);
            $entityManager->flush();
        }

        return $form;
    }

}
