<?php
require_once __DIR__."/../views/database.php";
$dbh = Database::connect();

if (!empty($_POST)) {
    
    $fileName = $_FILES['image']['name'];
    $targetFile = "./upload/$fileName";

    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

    $password = hash("sha256", $_POST["password"]);
    $salt = hash("sha256", bin2hex(random_bytes(15)));
    $password = hash("sha256", $salt . $password);

    $stmt = $dbh->prepare("INSERT INTO `user` (email, image, pseudo) VALUES (?,?,?)");
    $stmt->execute([
        $_POST["email"],
        $targetFile,
        $_POST["pseudo"]
    ]);

    $user_id = $dbh->lastInsertId();

    $stmt = $dbh->prepare("INSERT INTO `password` (user_id,password) VALUES (?,?)");
    $stmt->execute([
        $user_id,
        $password,

    ]);
    $stmt = $dbh->prepare("INSERT INTO `pass_sal` (pass_prefix,user_id) VALUES (?,?)");
    $stmt->execute([
        $salt,
        $user_id,

    ]);

    echo ' ';

    Database::disconnect();
    header("Location: /views/registration.php?status=created");
}else{
    header("Location: /views/registration.php");
}