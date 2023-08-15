<?php

require_once 'Model/Article.php';
require_once 'View/View.php';

class ControllerHome {

  private $article;

  public function __construct() {
    $this->article = new Article();
  }

  public function home() {
    $articles = $this->article->getArticles();
    $view = new View("Home");
    $view->generate(array('articles' => $articles));
  }

  public function loginPage() {
    $view = new View('Login');
    $view->generate([]);
}
}