<?php

require_once 'Controller/ControllerHome.php';
require_once 'Controller/ControllerArticle.php';
require_once 'View/View.php';
class Router {

    private $ctrlhome;
    private $ctrlarticle;

    public function __construct() {
        $this->ctrlhome = new ControllerHome();
        $this->ctrlarticle = new ControllerArticle();
    }

    // Route une requête entrante : exécution l'action associée
    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'article') {
                    $idarticle = intval($this->getParametre($_GET, 'id'));
                    if ($idarticle != 0) {
                        $this->ctrlarticle->article($idarticle);
                    }
                    else
                        throw new Exception("Identifiant de article non valide");
                }
                else if ($_GET['action'] == 'comment') {
                    $auteur = $this->getParametre($_POST, 'auteur');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idarticle = $this->getParametre($_POST, 'id');
                    $this->ctrlarticle->Comment($auteur, $contenu, $idarticle);
                }

                else if ($_GET['action'] == 'ajouter_article_form') {
                    $this->ctrlarticle->newarticleForm();
                } 
                
                else if ($_GET['action'] == 'ajouter_article') {
                    $titre = $this->getParametre($_POST, 'titre');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $this->ctrlarticle->ajouterarticle($titre, $contenu);
                } 
                
                else if ($_GET['action'] == 'supprimer_article') {
                    $idarticle = $this->getParametre($_GET, 'id');
                    $this->ctrlarticle->deletearticle($idarticle);
                }

                else if ($_GET['action'] == 'modifier_article_form') {
                    $idArticle = $this->getParametre($_GET, 'id');
                    $this->ctrlarticle->modifyArticleForm($idArticle);
                } 
                
                else if ($_GET['action'] == 'modifier_article') {
                    $idArticle = $this->getParametre($_POST, 'idArticle');
                    $titre = $this->getParametre($_POST, 'titre');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $this->ctrlarticle->modifyArticle($idArticle, $titre, $contenu);
                }
                
                else
                    throw new Exception("Action non valide");
            }
            
            else {  // aucune action définie : affichage de l'home
                $this->ctrlhome->home();
            }
        }
        catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    private function error($msgError) {
        $vue = new View("Error");
        $vue->generer(array('msgError' => $msgError));
    }

    // Recherche un paramètre dans un tableau
    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        }
        else
            throw new Exception("Paramètre '$nom' absent");
    }

}