<?php

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener 
{

    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        /**
         * @var User $user
         */
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $data['user'] = [
            'id' => $user->getId(),
            'email' => $user->getUserIdentifier(),
            'lastName' => $user->getLastName(),
            'firstName' => $user->getFirstName(),
            'avatar' =>[ 
                'id' => $user->getAvatar()->getId(),
                'name' => $user->getAvatar()->getName(),
                'image_url' => $user->getAvatar()->getImageUrl()
            ]
        ];

        $event->setData($data);
    }
}