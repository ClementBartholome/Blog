<?php 

require_once 'Model.php';

class User extends Model {
    public function authenticate(string $login, string $password): array|false {
        $sql = 'SELECT * FROM T_user WHERE USR_LOGIN=? AND USR_PASSWORD=?';
        $user = $this->executeRequest($sql, array($login, $password));
        if ($user->rowCount() > 0)
            return $user->fetch(); 
        else
            return false;
    }
}
