<?php

class ControllerHome {

  private ArticleManager $articleManager;

  public function __construct() {
    $this->articleManager = new ArticleManager();
  }

  public function home($page = 1): void {
    $articlesPerPage = 2;

    // Retrieve articles for the specified page
    $articles = $this->articleManager->getArticlesByPage($page, $articlesPerPage);

   
    // Get the total number of articles
    $totalArticles = $this->articleManager->getTotalArticles();
    
    // Calculate the total number of pages needed for pagination
    $totalPages = ceil($totalArticles / $articlesPerPage);

    $view = new View("Home");

    // Generate the view with necessary data
    $view->generate([
      'articles' => $articles,
      'currentPage' => $page,
      'totalPages' => $totalPages 
  ]);
}

  public function loginPage() {
    $view = new View('Login');
    $view->generate([]);
}
}