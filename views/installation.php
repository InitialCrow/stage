<?php
function deploy (){

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    
    try{
        $dbco = new PDO("mysql:host=$servername", $username, $password);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "CREATE DATABASE app";
        $dbco->exec($sql);
        
        echo 'Base de données créée bien créée !';
    }
    
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    }

    $servname = 'localhost';
    $dbname = 'app';
    $user = 'root';
    $pass = '';
    
    try{
        $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "CREATE TABLE User(
                id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(80) NOT NULL,
                picture VARCHAR(80) NOT NULL,
                pseudo VARCHAR(80) NOT NULL);

                CREATE TABLE Pass_sal(
                id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                pass_prefix VARCHAR(80) NOT NULL,
                user_id  BIGINT NOT NULL,
                CONSTRAINT fk_user_pass_sal
                FOREIGN KEY (user_id)
                REFERENCES User(id)) ;

                CREATE TABLE Password(
                id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                password VARCHAR(80) NOT NULL,
                user_id  BIGINT NOT NULL,
                CONSTRAINT fk_user_password
                FOREIGN KEY (user_id)
                REFERENCES User(id));

                CREATE TABLE Reset_password(
                id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                url_token VARCHAR(80) NOT NULL,
                user_id  BIGINT NOT NULL,
                CONSTRAINT fk_user_reset_password
                FOREIGN KEY (user_id)
                REFERENCES User(id)) ";
        
        $dbco->exec($sql);
        echo 'Table bien créée !';
    }
    
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    }


}
$exec=deploy();