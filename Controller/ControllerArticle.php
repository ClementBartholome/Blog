<?php

require_once 'Model/Article.php';
require_once 'Model/Comment.php';
require_once 'View/View.php';

class ControllerArticle {

    private $article;
    private $comment;

    public function __construct() {
        $this->article = new Article();
        $this->comment = new Comment();
    }

    // Affiche les détails sur un article
    public function article($idarticle) {
        $article = $this->article->getArticle($idarticle);
        $comments = $this->comment->getComments($idarticle);
        $view = new View("article");
        $view->generer(array('article' => $article, 'comments' => $comments));
    }

    // Ajoute un comment à un article
    public function Comment($auteur, $contenu, $idarticle) {
        // Sauvegarde du comment
        $this->comment->ajouterComment($auteur, $contenu, $idarticle);
        // Actualisation de l'affichage du article
        $this->article($idarticle);
    }

    public function newarticleForm() {
        $view = new View("NewArticle");
        $view->generer(array('contenu' => ''));
    }
    
    // Traite le formulaire et ajoute le article
    public function ajouterarticle($titre, $contenu) {
        $this->article->ajouterarticle($titre, $contenu);
        header("Location: index.php");
        exit();
    }

    public function deletearticle($idarticle) {
        $this->article->deletearticle($idarticle);
        header("Location: index.php");
        exit();
    }

    public function modifyArticleForm($idArticle) {
        $article = $this->article->getArticle($idArticle);
        $view = new View("ModifyArticle");
        $view->generer(array('article' => $article));
    }
    
    public function modifyArticle($idArticle, $titre, $contenu) {
        $this->article->modifyArticle($idArticle, $titre, $contenu);
        header("Location: index.php?action=article&id=$idArticle");
        exit();
    }
}
