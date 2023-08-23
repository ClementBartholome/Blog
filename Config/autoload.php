<?php 

spl_autoload_register(function($className) {
    if (file_exists("Controller/" . $className . ".php")) {
        require_once "Controller/" . $className . ".php";
    } else if (file_exists("Model/" . $className . ".php")) {
        require_once "Model/" . $className . ".php";
    }  else if (file_exists("Service/" . $className . ".php")) {
        require_once "Service/" . $className . ".php";
    } else if (file_exists("View/" . $className . ".php")) {
        require_once "View/" . $className . ".php";
    }
});

