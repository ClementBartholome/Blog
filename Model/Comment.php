<?php

require_once 'Model.php';

class Comment extends Model {

// Renvoie la liste des comments associés à un billet
    public function getComments($idArticle) {
        $sql = 'select COM_ID as id, COM_DATE as date,'
                . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_comment'
                . ' where BIL_ID=?';
        $comments = $this->executeRequest($sql, array($idArticle));
        return $comments;
    }

    public function ajouterComment($author, $content, $idArticle) {
        $sql = 'insert into T_comment(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID)'
            . ' values(?, ?, ?, ?)';
        $date = date(DATE_W3C);
        $this->executeRequest($sql, array($date, $author, $content, $idArticle));
    }
}