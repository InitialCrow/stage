<?php
require_once __DIR__."/../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();
class Database { // Fichier de configuration de la connexion à la BDD MySQL 

    private static $dbh = null;
    
    public static function connect() {
        if (null == self::$dbh) {
            try { // On créé une nouvelle instance de PDO pour permettre la connexion 
                self::$dbh = new PDO(
                    "mysql:host=".$_ENV['DB_HOST'].";"."dbname=".$_ENV['DB_NAME'],
                    $_ENV['DB_USER'], $_ENV['DB_PASS']
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

