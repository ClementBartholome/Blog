<?php

require_once 'Model/Article.php';
require_once 'Model/Comment.php';
require_once 'View/View.php';

class ControllerArticle {

    private Article $article;
    private Comment $comment;

    public function __construct() {
        $this->article = new Article();
        $this->comment = new Comment();
    }

    public function article(int $idArticle): void {
        $article = $this->article->getArticle($idArticle);
        $comments = $this->comment->getComments($idArticle);
        $view = new View("article");
        $view->generate(['article' => $article, 'comments' => $comments]);
    }

    public function Comment(string $author, string $content, int $idArticle): void {
        $this->comment->addComment($author, $content, $idArticle);
        $this->article($idArticle);
    }

    public function newArticleForm(): void {
        $view = new View("NewArticle");
        $view->generate(['content' => '']);
    }
    
    public function addArticle(string $title, string $content): void {
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
    

    public function deleteArticle(int $idArticle): void {
        $article = $this->article->getArticle($idArticle);
        $this->article->deleteArticle($idArticle);
        $imagePath = './images/' . basename($article['image']);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        header("Location: index.php");
        exit();
    }
    

    public function modifyArticleForm(int $idArticle): void {
        $article = $this->article->getArticle($idArticle);
        $view = new View("ModifyArticle");
        $view->generate(['article' => $article]);
    }
    
    public function modifyArticle(int $idArticle, string $title, string $content): void {
        $this->article->modifyArticle($idArticle, $title, $content);
        header("Location: index.php?action=article&id=$idArticle");
        exit();
    }
}
