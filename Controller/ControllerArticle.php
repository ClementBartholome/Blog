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
    public function article($idArticle) {
        $article = $this->article->getArticle($idArticle);
        $comments = $this->comment->getComments($idArticle);
        $view = new View("article");
        $view->generate(array('article' => $article, 'comments' => $comments));
    }

    // Ajoute un comment à un article
    public function Comment($author, $content, $idArticle) {
        // Sauvegarde du comment
        $this->comment->ajouterComment($author, $content, $idArticle);
        // Actualisation de l'affichage du article
        $this->article($idArticle);
    }

    public function newarticleForm() {
        $view = new View("NewArticle");
        $view->generate(array('content' => ''));
    }
    
    // Traite le formulaire et ajoute le article
    public function addArticle($title, $content) {
        // Récupérez le fichier envoyé
        $image = isset($_FILES['image']) ? $_FILES['image'] : null;
    
        // Vérifiez s'il y a une image envoyée
        if (!empty($image['name'])) {
            // Définissez le chemin de sauvegarde pour l'image
            $uploadDir = './images/';
            $uploadFile = $uploadDir . basename($image['name']);
    
            // Déplacez l'image téléchargée vers le dossier de destination
            if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
                // L'image a été téléchargée avec succès, vous pouvez enregistrer le chemin dans la base de données
                $this->article->addArticle($title, $content, $uploadFile);
            }
        } else {
            // Aucune image envoyée, enregistrez l'article sans image
            $this->article->addArticle($title, $content, null);
        }
    
        header("Location: index.php");
        exit();
    }
    

    public function deletearticle($idArticle) {
        $this->article->deletearticle($idArticle);
        header("Location: index.php");
        exit();
    }

    public function modifyArticleForm($idArticle) {
        $article = $this->article->getArticle($idArticle);
        $view = new View("ModifyArticle");
        $view->generate(array('article' => $article));
    }
    
    public function modifyArticle($idArticle, $title, $content) {
        $this->article->modifyArticle($idArticle, $title, $content);
        header("Location: index.php?action=article&id=$idArticle");
        exit();
    }
}
