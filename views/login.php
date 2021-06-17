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
        session_start();
        include "./database.php";
        $dbh = Database::connect();

        if (isset($_POST['pseudo']));
        if (isset($_POST['password']));

        /*************************************LOGIN******************************************************** */
        if ($_POST) { // Si le formulaire HTML a été soumis, 


            $req = $dbh->query("SELECT * FROM `user` WHERE pseudo='{$_POST['pseudo']}'");
            $user = $req->fetch();
            $req1 = $dbh->query("SELECT * FROM `password` ");
            $password = $req1->fetch();
            $pass = password_verify($_POST["password"], $password["password"]);

            // Si l'utilisateur existe et que son mot de passe correspond à celui enregistré en BDD,
            if ($user && $pass) {
                $_SESSION["pseudo"] = $_POST["pseudo"];; // On connecte l'utilisateur en passant son username dans la session
                header("Location: home.php"); // Redirection vers 'index.php'
            } else { // Affichage des messages d'erreurs associées aux validations 
                echo '<div class="alert alert-danger">
                <b>Attention!</b> votre identifiant ou votre mot de passe sont incorect !!!
                </div> ';
            }
        }
        Database::disconnect();

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

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form id="inscription" method="post">
                    <div class="box box-primary">
                        <div class="box-body box-profile">


                            <div class="row d-flex">
                                <div class="form-group col ">
                                    <label for="pseudo">Pseudo</label>
                                    <input type="text" class="form-control " name="pseudo" id="pseudo" aria-describedby="pseudoHelp" placeholder="Votre pseudo..." required minlength="8" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">
                                    <small id="pseudoLog" class="form-text text-muted">Votre pseudo doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres, et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.
                                    </small>
                                </div>

                                <div class=" d-flex justify-content-center col   " id="profile-container ">
                                    <img class="mx-auto" id="profileImage" src="https://www.icone-png.com/png/48/48154.png" />
                                </div>
                                <input id="imageUpload" name="picture" type="file" placeholder="Photo" required="" capture>

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control " name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Votre email..." required minlength="5" maxlength="40" pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})">
                            <small class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" class="form-control" id="Password" name="password" placeholder="confirmer votre mot de passe ..." required minlength="8" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">
                            <small class="form-text text-muted">Votre mot de passe doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres, et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.</small>
                        </div>
                        <div class="form-group">
                            <label for="Password2">Confirmation Password</label>
                            <input type="password" class="form-control" id="Password2" name="password2" placeholder="Reconfirmer votre mot de passe ..." required minlength="8" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">

                            <p id="success"></p>
                            <p id="erreur"></p>

                        </div>

                        <button type="submit" class="btn btn-primary" onclick="verif()">Submit</button>
                    </div>

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




















?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="login.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>