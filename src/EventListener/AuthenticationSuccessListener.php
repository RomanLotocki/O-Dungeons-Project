<?php

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener 
{

    /**
     * Sends user datas with JWT
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
            'avatar' => $user->getAvatar() !== null ? [
                'id' => $user->getAvatar()->getId(),
                'name' => $user->getAvatar()->getName(),
                'imageUrl' => $user->getAvatar()->getImageUrl()
            ]: null
        ];

        $event->setData($data);
    }
}