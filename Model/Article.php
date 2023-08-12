<?php

require_once 'Model.php';

class Article extends Modele {

    /** Renvoie la liste des articles du blog
     * 
     * @return PDOStatement La liste des articles
     */
    public function getarticles() {
        $sql = 'SELECT BIL_ID AS id, BIL_DATE AS date,'
                . ' BIL_TITRE AS titre, BIL_CONTENU AS contenu, BIL_IMAGE AS image'
                . ' FROM T_article'
                . ' ORDER BY BIL_ID DESC';
        $articles = $this->executerRequete($sql);
        return $articles;
    }
    

    /** Renvoie les informations sur un article
     * 
     * @param int $id L'identifiant de l'article
     * @return array L'article
     * @throws Exception Si l'identifiant du article est inconnu
     */
    public function getarticle($idarticle) {
        $sql = 'SELECT BIL_ID AS id, BIL_DATE AS date,'
                . ' BIL_TITRE AS titre, BIL_CONTENU AS contenu, BIL_IMAGE AS image'
                . ' FROM T_article'
                . ' WHERE BIL_ID=?';
        $article = $this->executerRequete($sql, array($idarticle));
        if ($article->rowCount() > 0)
            return $article->fetch(); 
        else
            throw new Exception("Aucun article ne correspond à l'identifiant '$idarticle'");
    }

    
    public function ajouterarticle($titre, $contenu, $image) {
        $sql = 'INSERT INTO T_article (BIL_TITRE, BIL_CONTENU, BIL_DATE, BIL_IMAGE) VALUES (?, ?, NOW(), ?)';
        $this->executerRequete($sql, array($titre, $contenu, $image));
    }

    public function deletearticle($idarticle) {
        $sql = 'DELETE FROM T_article WHERE BIL_ID=?';
        $this->executerRequete($sql, array($idarticle));
    }

    public function modifyArticle($idArticle, $titre, $contenu) {
        $sql = 'UPDATE T_article SET BIL_TITRE=?, BIL_CONTENU=? WHERE BIL_ID=?';
        $this->executerRequete($sql, array($titre, $contenu, $idArticle));
    }
}