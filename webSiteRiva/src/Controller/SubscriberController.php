<?php

namespace App\Controller;

use App\Entity\Subscriber;
use App\Form\SubscriberFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class SubscriberController extends AbstractController
{
    /**
     * @Route("/subscriber", name="app_subscriber")
     */
    public function form(Environment $twig, Request $request, EntityManagerInterface $entityManager): Response
    {
        $subscriber = new Subscriber();

        $form = $this->createForm(SubscriberFormType::class, $subscriber);

        $form->handleRequest($request);

        $agreeTerms = $form->get('agreeTerms')->getData();
        if ($form->isSubmitted() && $form->isValid() && $agreeTerms){

            $entityManager->persist($subscriber);
            $entityManager->flush();
            return new Response('Assinante número ' . $subscriber->getId() . ' criado...');
        }

        return $this->render('subscriber/form.html.twig', [
            'subscriber_form' => $form->createView()
        ]);
    }
}
