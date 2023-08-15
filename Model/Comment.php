<?php

require_once 'Model.php';

class Comment extends Model {

    public function getComments(int $idArticle): PDOStatement {
        $sql = 'SELECT COM_ID as id, COM_DATE as date,'
            . ' COM_AUTEUR as author, COM_CONTENU as content FROM T_comment'
            . ' WHERE BIL_ID=?';
        $comments = $this->executeRequest($sql, [$idArticle]);
        return $comments;
    }

    public function addComment(string $author, string $content, int $idArticle): void {
        $sql = 'INSERT INTO T_comment(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID)'
            . ' VALUES(?, ?, ?, ?)';
        $date = date(DATE_W3C);
        $this->executeRequest($sql, [$date, $author, $content, $idArticle]);
    }
}
