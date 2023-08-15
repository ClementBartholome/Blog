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

    public function article($idArticle) {
        $article = $this->article->getArticle($idArticle);
        $comments = $this->comment->getComments($idArticle);
        $view = new View("article");
        $view->generate(array('article' => $article, 'comments' => $comments));
    }

    public function Comment($author, $content, $idArticle) {
        $this->comment->addComment($author, $content, $idArticle);
        $this->article($idArticle);
    }

    public function newArticleForm() {
        $view = new View("NewArticle");
        $view->generate(array('content' => ''));
    }
    
    public function addArticle($title, $content) {
        // Get the sent file
        $image = isset($_FILES['image']) ? $_FILES['image'] : null;
    
        // Check if the file is an image
        if (!empty($image['name'])) {
            $uploadDir = './images/';
            $uploadFile = $uploadDir . basename($image['name']);
    
            // Check if the file has been uploaded
            if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
                $this->article->addArticle($title, $content, $uploadFile);
            }
        } else {
            // No image sent, add the article without image
            $this->article->addArticle($title, $content, null);
        }
    
        header("Location: index.php");
        exit();
    }
    

    public function deletearticle($idArticle) {
        $article = $this->article->getArticle($idArticle);
        $this->article->deletearticle($idArticle);
        $imagePath = './images/' . basename($article['image']);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
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
