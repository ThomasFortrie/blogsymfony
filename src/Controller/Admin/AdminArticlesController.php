<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
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

        return $this->render('admin/allArticles.html.twig',
        [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.article.edit")
     */
    public function edit(Articles $article)
    {
        return $this->render('admin/edit.html.twig', [
            'article' => $article
        ]);
    }




}
