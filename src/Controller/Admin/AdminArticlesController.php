<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Form\ArticleType;
use App\Repository\ArticlesRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminArticlesController extends AbstractController
{

    private $articleRepository;


    public function __construct(ArticlesRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }


    /**
     * @Route("/admin/articles", name="admin.articles" )
     */
    public function indexAllArticles()
    {
        $articles = $this->articleRepository->findAll();

        return $this->render(
            'admin/allArticles.html.twig',
            [
                'articles' => $articles
            ]
        );
    }


    /**
     * @Route("/admin/article/new", name="admin.article.new")
     */
    public function new(Request $request)
    {
        $article = new Articles();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('admin.articles');
        }

        return $this->render('admin/new.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }



    /**
     * @Route("/admin/edit/{id}", name="admin.edit")
     */
    public function edit(Articles $article, Request $request)
    {

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('admin.articles');
        }


        return $this->render('admin/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/sup/{id}", name="admin.article.sup")
     */
    public function sup($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Articles::class)->find($id);

        if (!$article) {
            throw $this->createNotFoundException('Pas d\'article trouvé pour l\'id ' . $id);

            return $this->redirectToRoute('admin.articles');
        } else {
            $entityManager->remove($article);
            $entityManager->flush();

            return $this->redirectToRoute('admin.articles');
        }
    }
}
