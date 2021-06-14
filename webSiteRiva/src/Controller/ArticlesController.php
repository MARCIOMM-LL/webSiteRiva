<?php


namespace App\Controller;


use App\Entity\Subscriber;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="app_home_page")
     */
    public function homepage(Environment $twigEnvironment)
    {
        $html = $twigEnvironment->render('articles/homepage.html.twig');
        return new Response($html);
    }

    /**
     * @Route("/article/{slug}")
     */
    public function show($slug)
    {
        $respostas = [
            'Barrachas',
            'Canetas',
            'Folhas A4',
            'Lápis',
            'Cadeiras'
        ];

        return $this->render('articles/show.html.twig', [
            'article' => ucwords(str_replace('-', ' ', $slug)),
            'respostas' => $respostas
        ]);

    }

    /**
     * @Route("/carousel", name="app_carousel")
     */
    public function carousel(Environment $twigEnvironment)
    {
        $html = $twigEnvironment->render('articles/carousel.html.twig');
        return new Response($html);
    }

    /**
     * @Route("/article/edit/{id}", name="edit_article")
     * * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $subscriber = new Subscriber();
        $subscriber = $this->getDoctrine()->getRepository(Subscriber::class)->find($id);

        $form = $this->createFormBuilder($subscriber)
            ->add('nome', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('email', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('telefone', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('mensagem', TextareaType::class, array(
                'required' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('app_view');
        }

        return $this->render('articles/view.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/article/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $article = $this->getDoctrine()->getRepository(Subscriber::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
}