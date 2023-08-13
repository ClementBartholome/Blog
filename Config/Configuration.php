<?php

class Configuration {

    /** Tableau des paramètres de configuration */
    private static $parametres;

    /**
     * Renvoie la value d'un paramètre de configuration
     * 
     * @param string $name name du paramètre
     * @param string $defaultValue value à renvoyer par défaut
     * @return string value du paramètre
     */
    public static function get($name, $defaultValue = null) {
        if (isset(self::getParametres()[$name])) {
            $value = self::getParametres()[$name];
        }
        else {
            $value = $defaultValue;
        }
        return $value;
    }

    /**
     * Renvoie le tableau des paramètres en le chargeant au besoin depuis un fichier de configuration.
     * Les fichiers de configuration recherchés sont Config/dev.ini et Config/prod.ini (dans cet ordre)
     * 
     * @return array Tableau des paramètres
     * @throws Exception Si aucun fichier de configuration n'est trouvé
     */
    private static function getParametres() {
        if (self::$parametres == null) {
            $filePath = "Config/dev.ini";
            if (!file_exists($filePath)) {
                $filePath = "Config/prod.ini";
            }
            if (!file_exists($filePath)) {
                throw new Exception("Aucun fichier de configuration trouvé");
            }
            else {
                self::$parametres = parse_ini_file($filePath);
            }
        }
        return self::$parametres;
    }
}