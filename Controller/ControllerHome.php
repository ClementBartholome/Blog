<?php

require_once 'Model/ArticleManager.php';
require_once 'View/View.php';

class ControllerHome {

  private ArticleManager $articleManager;

  public function __construct() {
    $this->articleManager = new ArticleManager();
  }

  public function home($page = 1): void {
    $articlesPerPage = 2;

    $articles = $this->articleManager->getArticlesByPage($page, $articlesPerPage);

    // Calcul du nombre total d'articles
    $totalArticles = $this->articleManager->getTotalArticles();
    
    // Calcul du nombre total de pages
    $totalPages = ceil($totalArticles / $articlesPerPage);

    $view = new View("Home");
    $view->generate([
        'articles' => $articles,
        'currentPage' => $page,
        'totalPages' => $totalPages  // Passer le nombre total de pages à la vue
    ]);
}

  public function loginPage() {
    $view = new View('Login');
    $view->generate([]);
}
}