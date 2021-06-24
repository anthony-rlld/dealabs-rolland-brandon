<?php

namespace App\Controller;

use App\Entity\Deal;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{username}", name="app_user")
     * @param string $username
     * @return Response
     */
    public function index(string $username): Response
    {
        $userToVisite = $this->getDoctrine()
                ->getRepository(User::class)
                ->findby(array("name" => $username))[0];
        $visit = !($this->getUser() && $userToVisite->getId() === $this->getUser()->getId());

        $maxDegree = $this->GetMaxDegree($userToVisite);
        $moyDegree = $this->GetMoyenneDegree($userToVisite);
        $percentHot = $this->GetPercentHot($userToVisite);
        $createdDeals = $userToVisite->getDeals();
        return $this->render('user/index.html.twig', [
            'user' => $userToVisite,
            'maxDegree' => $maxDegree,
            'moyDegree' => $moyDegree,
            'percentHot' => $percentHot,
            'createdDeals' => $createdDeals,
            'visit' => $visit
        ]);
    }

    /**
     * @Route("/user/deals", name="app_user_deals")
     */
    public function dealsByUser(): Response
    {
        return $this->render('user/deals.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @param User $user
     * @return int|mixed
     */
    private function GetMaxDegree(User $user): int
    {
        $res = $this->getDoctrine()->getRepository(Deal::class)
            ->findMaxDegreeByUser($user->getId());

        return isset($res[0]['maxDegree']) ? $res[0]['maxDegree'] : 0;
    }

    /**
     * @param User $user
     * @return int|mixed
     */
    private function GetMoyenneDegree(User $user): int
    {
        $res = $this->getDoctrine()->getRepository(Deal::class)
            ->findMoyenneDegreeByUser($user->getId());

        return isset($res[0]['moyDegree']) ? $res[0]['moyDegree'] : 0;
    }

    /**
     * @param User $user
     * @return int|mixed
     */
    private function GetPercentHot(User $user): int
    {
        $res = $this->getDoctrine()->getRepository(Deal::class)
            ->findHowManyHotByUser($user->getId(), 100);
        $nbDeal = $user->getDeals()->count();

        return $res[0]['nbHot'] > 0 ? ($res[0]['nbHot']/$nbDeal)*100 : 0;
    }
}
