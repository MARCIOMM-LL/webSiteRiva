<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MamiferoController extends AbstractController
{
    /**
     * @Route("/", name="app_home_page")
     */
    public function homepage()
    {
        return $this->render('mamiferos/homepage.html.twig');
    }

    /**
     * @Route("/mamifero/{slug}")
     */
    public function show($slug)
    {
        $respostas = [
            'Esta é a primeira resposta',
            'Esta é a segunda resposta',
            'Esta é a terceira resposta',
            'Esta é a quarta resposta',
            'Esta é a quinta resposta'
        ];

        return $this->render('mamiferos/show.html.twig', [
            'animal' => ucwords(str_replace('-', ' ', $slug)),
            'respostas' => $respostas
        ]);

    }
}