<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Events;
use App\Repository\BadgeRepository;
use App\Repository\UserRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CobayeSubscriber implements EventSubscriberInterface
{

    private $badgeRepository;
    private $userRepos;

    public function __construct(BadgeRepository $badgeRepository, UserRepository $userRepository)
    {
        $this->badgeRepository=$badgeRepository;
        $this->userRepos= $userRepository;
    }

    public function onCobayeBadge($event)
    {
        $user = $event->getSubject();

        if($user instanceof User) {
            $badge= $this->badgeRepository->find(2);
            $count = $user->getDeals()->count();
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
            Events::VALIDATED_COBAYE_BADGE => 'onCobayeBadge',
        ];
    }
}
