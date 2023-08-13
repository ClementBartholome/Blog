<?php

class View {

    // Nom du file associé à la view
    private $file;
    
    // title de la view (défini dans le file view)
    private $title;

    public function __construct($action) {
        // Détermination du nom du file view à partir de l'action
        $this->file = "View/view" . $action . ".php";
    }

    // Génère et affiche la view
    public function generate($data) {
        // Génération de la partie spécifique de la view
        $content = $this->generateFile($this->file, $data);
        // On définit une variable locale accessible par la view pour la racine Web
        // Il s'agit du chemin vers le site sur le serveur Web
        // Nécessaire pour les URI de type controleur/action/id
        $racineWeb = Configuration::get("racineWeb", "/");
        // Génération du gabarit commun utilisant la partie spécifique
        $view = $this->generateFile('View/template.php',
          array('title' => $this->title, 'content' => $content,
                'racineWeb' => $racineWeb));
        // Renvoi de la view générée au navigateur
        echo $view;
      }

    // Génère un file view et renvoie le résultat produit
    private function generateFile($file, $data) {
        if (file_exists($file)) {
            // Rend les éléments du tableau $data accessibles dans la view
            extract($data);
            // Démarrage de la temporisation de sortie
            ob_start();
            // Inclut le file view
            // Son résultat est placé dans le tampon de sortie
            require $file;
            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        }
        else {
            throw new Exception("file '$file' introuvable");
        }
    }

}