<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>login</title>
</head>

<body>


    <?php if (isset($_GET['status']) && $_GET['status'] === "expired") : ?>
        <div class="alert alert-warning">
            <b>Session Expirée</b> Merci de vous reconnecter.
        </div>
    <?php endif; ?>


    <div class="card mx-auto  " style="width:50vw;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active ">
                        <a class="nav-link text-primary" href="http://app.fr/views/login.php">Login <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="http://app.fr/views/registration.php">Registration</a>
                    </li>


                </ul>

            </div>
        </nav>
        <?php
        require_once "./database.php";
        $dbh = Database::connect();



        /*************************************LOGIN******************************************************** */
        if (isset($_POST)) { // Si le formulaire HTML a été soumis, 



            if (!empty($_POST["pseudo"]) && !empty($_POST["password"])) {


                $req = $dbh->prepare("
                    SELECT U.email, U.pseudo, U.id as user_id, U.image , PS.pass_prefix
                    FROM user U
                    INNER JOIN pass_sal PS ON PS.user_id = U.id 
                    WHERE U.pseudo= ?
                    LIMIT 1
                ");
                $req->execute([
                    $_POST["pseudo"]
                ]);


                $salt = $req->fetch();

                if (empty($salt)) {
                    echo "Erreur d'identifiant";
                    return false;
                }
                $password = hash("sha256", $_POST["password"]);

                $password = hash("sha256", $salt['pass_prefix'] . $password);


                $req = $dbh->prepare("
                    SELECT P.user_id 
                    FROM password P
                    WHERE P.password = ? AND P.user_id = ?
                    LIMIT 1
                ");
                $req->execute([
                    $password,
                    $salt['user_id']
                ]);

                $user = $req->fetch();

                if (empty($user)) {
                    echo "Erreur d'identifiant";
                    return false;
                } else {
                    $userData = [
                        "user_id" => $salt['user_id'],
                        "pseudo" => $salt['pseudo'],
                        "email" => $salt['email'],
                        "image" => $salt['image'],
                    ];
                    Database::disconnect();
                    $_SESSION['userData'] = $userData;
                    header('Location: /views/home.php');
                    return false;
                    exit;
                }
            }
        }


        ?>

        <div class="tab-content mx-5 mt-2 mb-2" id="myTabContent">
            <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="home-tab">
                <form method="post" name="contact">

                    <div class="form-group ">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" class="form-control " name="pseudo" id="pseudo" aria-describedby="pseudoHelp" placeholder="Votre pseudo..." required minlength="5" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">
                        <small id="pseudoLog" class="form-text text-muted">Votre pseudo doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres, et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.
                        </small>
                    </div>


                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="Password1" placeholder="Votre mot de passe..." required minlength="8" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">
                        <small id="passwordlog" class="form-text text-muted">Votre mot de passe doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres, et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.
                        </small>
                    </div>
                    <div class="etc-login-form">
                        <p>mot de passe oublie ? <a href="#"><i class="fas fa-lock fa-lg"></i></a></p>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>









        </div>



    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="login.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>