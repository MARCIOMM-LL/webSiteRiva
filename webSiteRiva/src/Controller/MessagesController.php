<?php


namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{
    /**
     * @Route("/messages/{id<\d+>}/like/{direction<like|dislike>}", methods="POST")
     */
    public function messagesLike($id, $direction, LoggerInterface $logger)
    {
        if ($direction === 'like'){
            $logger->info('Houve um Like!');
            $currentLike = rand(80,200);
        } else {
            $logger->info('Houve um Dislike!');
            $currentLike = rand(10,20);
        }

        return $this->json(['likes' => $currentLike]);
    }
}