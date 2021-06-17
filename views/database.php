<?php

class Database { // Fichier de configuration de la connexion à la BDD MySQL 
    private static $dbName = 'app'; // Nom de la BDD 
    private static $dbHost = 'localhost'; // Hôte de la BDD 
    private static $dbUsername = 'root'; // Nom d'utilisateur de la BDD 
    private static $dbUserPassword = ''; // Mot de passe de la BDD 
    private static $dbh = null;
    
    public static function connect() {
        if (null == self::$dbh) {
            try { // On créé une nouvelle instance de PDO pour permettre la connexion 
                self::$dbh = new PDO(
                    "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName,
                    self::$dbUsername, self::$dbUserPassword
                );
            } catch(PDOException $e) { // En cas d'erreur, le script PHP est stoppé avec un message d'erreur
                die($e->getMessage());
            }
       }
       return self::$dbh; // L'instance de PDO est retournée par la méthode 'connect()'
    }
     
    public static function disconnect() { // La méthode de déconnexion
        self::$dbh = null; // Elle se contente de remettre à 'null' à la variable stockant l'instance de PDO
    }
}

