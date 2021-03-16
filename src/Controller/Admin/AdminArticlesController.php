<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Form\ArticleType;
use App\Repository\ArticlesRepository;
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
     * @Route("/admin/edit/{id}", name="admin.edit")
     */
    public function edit(Articles $article)
    {

        $form = $this->createForm(ArticleType::class, $article);


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
