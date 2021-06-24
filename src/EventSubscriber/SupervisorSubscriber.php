<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Events;
use App\Repository\BadgeRepository;
use App\Repository\UserRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class SupervisorSubscriber implements EventSubscriberInterface
{

    private $badgeRepository;
    private $userRepos;

    public function __construct(BadgeRepository $badgeRepository, UserRepository $userRepository)
    {
        $this->badgeRepository=$badgeRepository;
        $this->userRepos= $userRepository;
    }

    public function onBadgeSupervisor(GenericEvent $event)
    {
        $user = $event->getSubject();

        if($user instanceof User) {
            $badge= $this->badgeRepository->find(1);
            $count = $user->getVotesList()->count();
            $haveBadge = $user->getBadges()->contains($badge);

            if($count >= 10 && !$haveBadge) {
                $manager = $event->getArgument("Manager");
                $user->addBadge($badge);
                $manager->persist($user);
                $manager->flush();
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            Events::VALIDATED_SUPERVISOR_BADGE => 'onBadgeSupervisor',
        ];
    }
}
