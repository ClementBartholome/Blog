<?php

require_once 'Model.php';

class Article extends Model {

    public function getArticles(): PDOStatement {
        $sql = 'SELECT BIL_ID AS id, BIL_DATE AS date,'
                . ' BIL_TITRE AS title, BIL_CONTENU AS content, BIL_IMAGE AS image'
                . ' FROM T_article'
                . ' ORDER BY BIL_ID DESC';
        $articles = $this->executeRequest($sql);
        return $articles;
    }

    public function getArticle(int $idArticle): array {
        $sql = 'SELECT BIL_ID AS id, BIL_DATE AS date,'
                . ' BIL_TITRE AS title, BIL_CONTENU AS content, BIL_IMAGE AS image'
                . ' FROM T_article'
                . ' WHERE BIL_ID=?';
        $article = $this->executeRequest($sql, [$idArticle]);
        if ($article->rowCount() > 0)
            return $article->fetch(); 
        else
            throw new Exception("Aucun article ne correspond à l'identifiant '$idArticle'");
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
