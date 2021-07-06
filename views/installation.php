<?php
function deploy()
{

  $servername = 'localhost';
  $username = 'phpmyadmin';
  $password = 'root';

  try {
    $dbco = new PDO("mysql:host=$servername", $username, $password);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE app";
    $dbco->exec($sql);

    echo 'Base de données créée bien créée !';
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }

  $servname = 'localhost';
  $dbname = 'app';
  $user = 'phpmyadmin';
  $pass = 'root';

  try {
    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE user(
                id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(80) NOT NULL,
                image VARCHAR(80) NOT NULL,
                pseudo VARCHAR(80) NOT NULL);

                CREATE TABLE pass_sal(
                id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                pass_prefix VARCHAR(80) NOT NULL,
                user_id  BIGINT NOT NULL,
                CONSTRAINT fk_user_pass_sal
                FOREIGN KEY (user_id)
                REFERENCES user(id)) ;

                CREATE TABLE password(
                id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                password VARCHAR(80) NOT NULL,
                user_id  BIGINT NOT NULL,
                CONSTRAINT fk_user_password
                FOREIGN KEY (user_id)
                REFERENCES user(id));

                CREATE TABLE reset_password(
                id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                url_token VARCHAR(80) NOT NULL,
                user_id  BIGINT NOT NULL,
                CONSTRAINT fk_user_reset_password
                FOREIGN KEY (user_id)
                REFERENCES user(id)) ";

    $dbco->exec($sql);
    echo 'Table bien créée !';
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}
$exec = deploy();
