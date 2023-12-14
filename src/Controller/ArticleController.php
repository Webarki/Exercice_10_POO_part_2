<?php

namespace App\src\Controller;

use App\src\Entity\Article;
use App\src\Controller\TwigController;

class ArticleController extends TwigController
{
    public function index()
    {
        $article = new Article;
        $articles = $article->getArticles();
        echo $this->twig->render("article/index.html.twig", [
            'articles' => $articles,
            'data' => 'Bienvenue sur le controller Article',
            'session' => $_SESSION
        ]);
    }

    public function view(int $params)
    {
        var_dump($params);
        $getArticle = new Article;
        $getArticle->id = $params;
        $article = $getArticle->getArticleById();
        echo $this->twig->render("article/index.html.twig", [
            'article' => $article,
            'data' => 'Bienvenue sur le controller Article/view',
            'session' => $_SESSION
        ]);
    }

    public function modify(int $params)
    {
        //var_dump($params);
        $getArticle = new Article;
        $getArticle->id = $params;
        $article = $getArticle->getArticleById();
        if (isset($_POST["btnUpdate"])) {
            $getArticle->id = $params;
            $getArticle->title = $_POST["title"];
            $getArticle->content = $_POST["content"];
            $getArticle->updateArticleById();
        }
        echo $this->twig->render("article/form.html.twig", [
            'article' => $article,
            'data' => 'Bienvenue sur le controller Article/modify/',
            'session' => $_SESSION
        ]);
    }
}
