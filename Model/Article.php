<?php

require_once 'Model.php';

class Article extends Model {

    /** Renvoie la liste des articles du blog
     * 
     * @return PDOStatement La liste des articles
     */
    public function getArticles() {
        $sql = 'SELECT BIL_ID AS id, BIL_DATE AS date,'
                . ' BIL_TITRE AS title, BIL_CONTENU AS content, BIL_IMAGE AS image'
                . ' FROM T_article'
                . ' ORDER BY BIL_ID DESC';
        $articles = $this->executeRequest($sql);
        return $articles;
    }
    

    /** Renvoie les informations sur un article
     * 
     * @param int $id L'identifiant de l'article
     * @return array L'article
     * @throws Exception Si l'identifiant du article est inconnu
     */
    public function getArticle($idArticle) {
        $sql = 'SELECT BIL_ID AS id, BIL_DATE AS date,'
                . ' BIL_TITRE AS title, BIL_CONTENU AS content, BIL_IMAGE AS image'
                . ' FROM T_article'
                . ' WHERE BIL_ID=?';
        $article = $this->executeRequest($sql, array($idArticle));
        if ($article->rowCount() > 0)
            return $article->fetch(); 
        else
            throw new Exception("Aucun article ne correspond à l'identifiant '$idArticle'");
    }

    
    public function addArticle($title, $content, $image) {
        $sql = 'INSERT INTO T_article (BIL_TITRE, BIL_CONTENU, BIL_DATE, BIL_IMAGE) VALUES (?, ?, NOW(), ?)';
        $this->executeRequest($sql, array($title, $content, $image));
    }

    public function deletearticle($idArticle) {
        $sql = 'DELETE FROM T_article WHERE BIL_ID=?';
        $this->executeRequest($sql, array($idArticle));
    }

    public function modifyArticle($idArticle, $title, $content) {
        $sql = 'UPDATE T_article SET BIL_TITRE=?, BIL_CONTENU=? WHERE BIL_ID=?';
        $this->executeRequest($sql, array($title, $content, $idArticle));
    }
}