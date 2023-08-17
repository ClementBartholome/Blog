<?php

// ArticleManager.php

require_once 'Model.php';
require_once 'Article.php';

class ArticleManager extends Model {

    // public function getLatestArticles(int $limit = 2, int $offset = 0): array {
    //     $sql = 'SELECT BIL_ID AS id, BIL_DATE AS date,'
    //             . ' BIL_TITRE AS title, BIL_CONTENU AS content, BIL_IMAGE AS image, BIL_CATEGORIE AS category'
    //             . ' FROM T_article'
    //             . ' ORDER BY BIL_ID DESC'
    //             . ' LIMIT ' . $limit . ' OFFSET ' . $offset;
    //     $articlesData = $this->executeRequest($sql);

    //     $articles = [];
    //     foreach ($articlesData as $articleData) {
    //         $article = new Article();
    //         $article->hydrate($articleData);
    //         $articles[] = $article;
    //     }
    
    //     return $articles;
    // }

    public function getArticlesByPage(int $page, int $articlesPerPage): array {
        $offset = ($page - 1) * $articlesPerPage;
        
        $sql = 'SELECT BIL_ID AS id, BIL_DATE AS date,'
                . ' BIL_TITRE AS title, BIL_CONTENU AS content, BIL_IMAGE AS image, BIL_CATEGORIE AS category'
                . ' FROM T_article'
                . ' ORDER BY BIL_ID DESC'
                . ' LIMIT ' . $articlesPerPage
                . ' OFFSET ' . $offset;
    
        $articlesData = $this->executeRequest($sql);
    
        $articles = [];
        foreach ($articlesData as $articleData) {
            $article = new Article();
            $article->hydrate($articleData);
            $articles[] = $article;
        }
    
        return $articles;
    }

    public function getTotalArticles(): int {
        $sql = 'SELECT COUNT(*) FROM T_article';
        $result = $this->executeRequest($sql);
        return (int) $result->fetchColumn();
    }

    public function getArticlesByCategory(string $category): array {
        $sql = 'SELECT BIL_ID AS id, BIL_DATE AS date,'
                . ' BIL_TITRE AS title, BIL_CONTENU AS content, BIL_IMAGE AS image, BIL_CATEGORIE AS category'
                . ' FROM T_article'
                . ' WHERE BIL_CATEGORIE = ?'
                . ' ORDER BY BIL_ID DESC';

        $articlesData = $this->executeRequest($sql, [$category]);

        $articles = [];
        foreach ($articlesData as $articleData) {
            $article = new Article();
            $article->hydrate($articleData);
            $articles[] = $article;
        }

        return $articles;
    }

    public function getArticle(int $idArticle): Article {
        $sql = 'SELECT BIL_ID AS id, BIL_DATE AS date,'
                . ' BIL_TITRE AS title, BIL_CONTENU AS content, BIL_IMAGE AS image, BIL_CATEGORIE AS category'
                . ' FROM T_article'
                . ' WHERE BIL_ID=?';
        $articleData = $this->executeRequest($sql, [$idArticle]);
        if ($articleData->rowCount() > 0) {
            $article = new Article();
            $article->hydrate($articleData->fetch());
            return $article;
        } else {
            throw new Exception("Aucun article ne correspond à l'identifiant '$idArticle'");
        }
    }

    public function addArticle(string $title, string $content, ?string $image, string $category): void {
        $sql = 'INSERT INTO T_article (BIL_TITRE, BIL_CONTENU, BIL_DATE, BIL_IMAGE, BIL_CATEGORIE) VALUES (?, ?, NOW(), ?, ?)';
        $this->executeRequest($sql, [$title, $content, $image, $category]);
    }

    public function deleteArticle(int $idArticle): void {
        $sql = 'DELETE FROM T_article WHERE BIL_ID=?';
        $this->executeRequest($sql, [$idArticle]);
    }

    public function modifyArticle(Article $article): void {
        $sql = 'UPDATE T_article SET BIL_TITRE=?, BIL_CONTENU=? WHERE BIL_ID=?';
        $this->executeRequest($sql, [$article->getTitle(), $article->getContent(), $article->getId()]);
    }
}
