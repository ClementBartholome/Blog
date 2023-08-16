<?php

require_once 'Model/ArticleManager.php';
require_once 'View/View.php';

class ControllerHome {

  private ArticleManager $articleManager;

  public function __construct() {
    $this->articleManager = new ArticleManager();
  }

  public function home() {
    $articles = $this->articleManager->getArticles();
    $view = new View("Home");
    $view->generate(['articles' => $articles]);
  }

  public function loginPage() {
    $view = new View('Login');
    $view->generate([]);
}
}