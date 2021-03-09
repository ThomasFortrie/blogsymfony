<?php

namespace App\Controller;

use App\Entity\Articles;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{



/**
 * @Route("")
 *
 * @return Response
 */
    public function home(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findAll();


        return $this->render('home.html.twig',[
            'articles' => $articles
        ]);
    }
}
