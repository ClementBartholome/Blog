<?php

// ArticleManager.php

require_once 'Model.php';
require_once 'Article.php';

class ArticleManager extends Model {

    public function getArticles(): array {
        $sql = 'SELECT BIL_ID AS id, BIL_DATE AS date,'
                . ' BIL_TITRE AS title, BIL_CONTENU AS content, BIL_IMAGE AS image'
                . ' FROM T_article'
                . ' ORDER BY BIL_ID DESC';
        $articlesData = $this->executeRequest($sql);
        
        $articles = [];
        foreach ($articlesData as $articleData) {
            $article = new Article();
            $article->setId($articleData['id']);
            $article->setDate($articleData['date']);
            $article->setTitle($articleData['title']);
            $article->setContent($articleData['content']);
            $article->setImage($articleData['image']);
            
            $articles[] = $article;
        }
        
        return $articles;
    }

    public function getArticle(int $idArticle): Article {
        $sql = 'SELECT BIL_ID AS id, BIL_DATE AS date,'
                . ' BIL_TITRE AS title, BIL_CONTENU AS content, BIL_IMAGE AS image'
                . ' FROM T_article'
                . ' WHERE BIL_ID=?';
        $articleData = $this->executeRequest($sql, [$idArticle]);
        
        if ($articleData->rowCount() > 0) {
            $articleRow = $articleData->fetch(PDO::FETCH_ASSOC);
            $article = new Article();
            $article->setId($articleRow['id']);
            $article->setDate($articleRow['date']);
            $article->setTitle($articleRow['title']);
            $article->setContent($articleRow['content']);
            $article->setImage($articleRow['image']);
            
            return $article;
        } else {
            throw new Exception("Aucun article ne correspond à l'identifiant '$idArticle'");
        }
    }

    public function addArticle(string $title, string $content, ?string $image): void {
        $sql = 'INSERT INTO T_article (BIL_TITRE, BIL_CONTENU, BIL_DATE, BIL_IMAGE) VALUES (?, ?, NOW(), ?)';
        $this->executeRequest($sql, [$title, $content, $image]);
    }

    public function deleteArticle(int $idArticle): void {
        $sql = 'DELETE FROM T_article WHERE BIL_ID=?';
        $this->executeRequest($sql, [$idArticle]);
    }

    public function modifyArticle(int $idArticle, string $title, string $content): void {
        $sql = 'UPDATE T_article SET BIL_TITRE=?, BIL_CONTENU=? WHERE BIL_ID=?';
        $this->executeRequest($sql, [$title, $content, $idArticle]);
    }
}
