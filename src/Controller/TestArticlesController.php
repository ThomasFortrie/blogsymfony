<?php

namespace App\Controller;

use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestArticlesController extends AbstractController
{
    /**
     * @Route("/test/articles", name="test_articles")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $article = new Articles;

        $article->setName('Titre de l\'article 06')
        ->setContenu('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in metus sit amet ligula feugiat feugiat in a justo. 
        Aenean dolor purus, ultricies sed purus non, 
        vehicula semper lacus. Vestibulum nisl tortor, 
        eleifend id tortor nec, condimentum iaculis erat. In at diam rutrum, aliquet est non, porta diam.');

        $entityManager->persist($article);

        $entityManager->flush($article);

        return new Response('Saves new Article with id'.$article->getId());
    }
}
