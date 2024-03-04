<?php

// Fonction d'autoload pour charger automatiquement les classes
spl_autoload_register(function ($class_name) {
    // Définir le répertoire racine de votre application
    $root_directory = __DIR__ . '/src/';

    // Convertir le nom de la classe en chemin de fichier
    $file_path = $root_directory . str_replace('\\', '/', $class_name) . '.php';

    // Inclure le fichier de classe si celui-ci existe
    if (file_exists($file_path)) {
        require_once $file_path;
    }
});

