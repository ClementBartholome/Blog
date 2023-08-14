<?php 

require_once 'Model.php';

class User extends Model {
    public function authenticate($login, $password) {
        $sql = 'SELECT * FROM T_user WHERE USR_LOGIN=? AND USR_PASSWORD=?';
        $user = $this->executeRequest($sql, array($_POST['login'], sha1($_POST['password'])));
        if ($user->rowCount() > 0)
            return $user->fetch(); 
        else
            return false;
    }
}