<?php

require_once 'Controller/ControllerHome.php';
require_once 'Controller/ControllerArticle.php';
require_once 'Controller/ControllerLogin.php';
require_once 'View/View.php';
class Router {

    private $ctrlhome;
    private $ctrlarticle;
    private $ctrllogin;

    public function __construct() {
        $this->ctrlhome = new ControllerHome();
        $this->ctrlarticle = new ControllerArticle();
        $this->ctrllogin = new ControllerLogin();
    }

    public function routerRequest() {
        try {
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                
                switch ($action) {
                    case 'article':
                        $idArticle = intval($this->getParametre($_GET, 'id'));
                        if ($idArticle != 0) {
                            $this->ctrlarticle->article($idArticle);
                        } else {
                            throw new Exception("Identifiant d'article non valide");
                        }
                        break;
                        
                    case 'comment':
                        $author = $this->getParametre($_POST, 'author');
                        $content = $this->getParametre($_POST, 'content');
                        $idArticle = $this->getParametre($_POST, 'id');
                        $this->ctrlarticle->addComment($author, $content, $idArticle);
                        break;
    
                    case 'new_article_form':
                        $this->ctrlarticle->newArticleForm();
                        break;
    
                    case 'add_article':
                        $title = $this->getParametre($_POST, 'title');
                        $content = $this->getParametre($_POST, 'content');
                        $category = $this->getParametre($_POST, 'category');
                        $this->ctrlarticle->addArticle($title, $content, $category);
                        break;
    
                    case 'modify_article_form':
                        $idArticle = $this->getParametre($_GET, 'id');
                        $this->ctrlarticle->modifyArticleForm($idArticle);
                        break;
    
                    case 'delete_article':
                        $idArticle = $this->getParametre($_GET, 'id');
                        $this->ctrlarticle->deleteArticle($idArticle);
                        break;
    
                    case 'modify_article':
                        $idArticle = $this->getParametre($_POST, 'idArticle');
                        $title = $this->getParametre($_POST, 'title');
                        $content = $this->getParametre($_POST, 'content');
                        $this->ctrlarticle->modifyArticle($idArticle, $title, $content);
                        break;
    
                    case 'loginform':
                        $this->ctrlhome->loginPage();
                        break;
    
                    case 'login':
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $login = $this->getParametre($_POST, 'login');
                            $password = $this->getParametre($_POST, 'password');
                            $this->ctrllogin->login($login, $password);
                        } else {
                            $this->ctrllogin->loginPage();
                        }
                        break;
    
                    case 'logout':
                        $this->ctrllogin->logout();
                        break;
    
                    case 'home':
                        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                        $this->ctrlhome->home($page);
                        break;
    
                    case 'category':
                        $category = isset($_GET['category']) ? urldecode($_GET['category']) : '';
                        $this->ctrlarticle->articlesByCategory($category);
                        break;
    
                    default:
                        throw new Exception("Action non valide");
                }
            } else {  // no action : display home
                $this->ctrlhome->home();
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
    

    private function error($msgError) {
        $vue = new View("Error");
        $vue->generate(array('msgError' => $msgError));
    }

    // Search the value of a parameter in a table
    private function getParametre($table, $name) {
        if (isset($table[$name])) {
            return $table[$name];
        }
        else
            throw new Exception("Paramètre '$name' absent");
    }
}