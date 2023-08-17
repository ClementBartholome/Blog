<?php

require_once 'Model/ArticleManager.php';
require_once 'Model/Comment.php';
require_once 'View/View.php';

class ControllerArticle {

    private ArticleManager $articleManager;
    private Comment $comment;

    public function __construct() {
        $this->articleManager = new ArticleManager();
        $this->comment = new Comment();
    }

    public function article(int $idArticle): void {
        $article = $this->articleManager->getArticle($idArticle);
        $comments = $this->comment->getComments($idArticle);
        $view = new View("article");
        $view->generate(['article' => $article, 'comments' => $comments]);
    }

    public function articlesByCategory(string $category): void {
        $articles = $this->articleManager->getArticlesByCategory($category);
        $view = new View("ArticlesByCategory");
        $view->generate(['articles' => $articles, 'category' => $category]);
    }

    public function addComment(string $author, string $content, int $idArticle): void {
        $this->comment->addComment($author, $content, $idArticle);
        $this->article($idArticle);
    }

    public function newArticleForm(): void {
        $view = new View("NewArticle");
        $view->generate(['content' => '']);
    }
    
    public function addArticle(string $title, string $content, string $category): void {
        // Get the sent file
        $image = isset($_FILES['image']) ? $_FILES['image'] : null;

        // Check if the file is an image
        if (!empty($image['name'])) {
            $uploadDir = './images/';
            $uploadFile = $uploadDir . basename($image['name']);

            // Check if the file has been uploaded
            if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
                $this->articleManager->addArticle($title, $content, $uploadFile, $category);
            }
        } else {
            // No image sent, add the article without image
            $this->articleManager->addArticle($title, $content, null, $category);
        }

        header("Location: index.php");
        exit();
    }
    
    public function deleteArticle(int $idArticle): void {
        $article = $this->articleManager->getArticle($idArticle);
        $this->articleManager->deleteArticle($idArticle);
        $imagePath = './images/' . basename($article->getImage());
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        header("Location: index.php");
        exit();
    }
    

    public function modifyArticleForm(int $idArticle): void {
        $article = $this->articleManager->getArticle($idArticle);
        $view = new View("ModifyArticle");
        $view->generate(['article' => $article]);
    }
    
    public function modifyArticle(int $idArticle, string $title, string $content): void {
        $article = $this->articleManager->getArticle($idArticle);
        $article->setTitle($title);
        $article->setContent($content);
        $this->articleManager->modifyArticle($article);
        header("Location: index.php?action=article&id=$idArticle");
        exit();
    }
}
