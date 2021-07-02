<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Changepassword</title>
</head>

<body>
    <?php
    require_once "./database.php";
    $dbh = Database::connect();

    $date = date("Y-m-d H:i:s", strtotime('now'));
  
    $url = $_SESSION['userData']['url_token'];
    $user_id = $_SESSION['userData']['user_id'];
    $urlexist = $dbh->prepare('SELECT * FROM Reset_password where url_token= ?');
    $urlexist->execute([
        $url,
    ]);
    $urlexist = $urlexist->rowCount();
  
    if ($date < $_SESSION["userData"]["date_expiry"] ) {
    
        
        ?>
        <div class="card mx-auto  " style="width:50vw;">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link text-primary" href="http://app.fr/views/login.php">Login <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="http://app.fr/views/registration.php">Registration</a>
                        </li>

                    </ul>

                </div>
            </nav>
        <?php
        if(empty($_POST)){

            ?>

            <form action="" id="form" class="form-group" method="post">
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control" id="Password" name="password" placeholder="Entrer votre mot nouveau mot de passe ..." required minlength="8" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">
                    <small class="form-text text-muted">Votre mot de passe doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres, et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.</small>
                </div>
                <div class="form-group">
                    <label for="Password2">Confirmation Password</label>
                    <input type="password" class="form-control" id="Password2" name="password2" placeholder="Reconfirmer votre nouveau mot de passe ..." required minlength="8" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">

                    <p id="success"></p>
                    <p id="erreur"></p>

                </div>
                <button type="submit" class="btn btn-info" name="submit" onclick="verif()">Mettre a jour</button>


            </form>

        </div>

    <?php

}

if (!empty($_POST)) {
    
    $password = hash("sha256", $_POST["password"]);
    $salt = hash("sha256", random_bytes(15));
    $password = hash("sha256", $salt . $password);
    
    $req = $dbh->prepare("
    SELECT U.email, U.pseudo, U.id as user_id, U.image 
    FROM user U                    
    WHERE U.email= ?
    LIMIT 1
    ");

            $req->execute([
                $_SESSION["userData"]["email"]
            ]);

            $user_id = $_SESSION["userData"]["user_id"];
           
            $stmt = $dbh->prepare("UPDATE `password`  set password= ? where user_id=$user_id ");
            $stmt->execute([
                $password,
            ]);

            $stmt = $dbh->prepare("UPDATE `pass_sal` set pass_prefix=? where user_id=$user_id");
            $stmt->execute([
                $salt,
            ]);

            

            echo '<div class="alert alert-success">
                            <b>Felicitation ! </b> votre mot de passe a bien ete changer !!!
                            </div> ';
                            session_destroy();
        }
    } else {

        echo '<div class="alert alert-danger">
        <b>Attention !</b> Votre lien est expirer , merci de redemander un nouveau lien  !!!!
        </div> ';
        $delete_token = $dbh->prepare('DELETE  FROM reset_password where user_id= ?');
        $delete_token->execute([
            $user_id,
        ]);
    }

    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="login.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>