<?php

session_start();

if (!isset($_SESSION) || empty($_SESSION) || !isset($_SESSION['userData'])) {
    header('Location: /views/login.php?status=expired');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Home</title>
</head>

<body>
    <?php
    //include "./database.php";
    //$dbh = Database::connect();


   
  
    ?>
    <div  id="formulaire" class=" container  mx-auto mt-2 mb-2">
        <div class="card mx-auto mt-2 mb-2" style="width: 18rem;">
            <img class="card-img-top" src="<?= $_SESSION["userData"]["image"] ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?= $_SESSION["userData"]["pseudo"] ?></h5>
                <p class="card-text"><?= $_SESSION["userData"]["email"] ?></p>
                <button type="submit" class="btn btn-info" onclick="display();">Modifier</button>
            </div>
        </div>
    </div>


    <div  id="formulaire2" class=" container  mx-auto mt-2 mb-2">
    <form id="inscription" method="post" enctype="multipart/form-data">
        <div class="card mx-auto mt-2 mb-2" style="width: 18rem;">
            <label class="text-center font-weight-bold" for="image">Modifier votre avatar</label>
            <img class="card-img-top" src="<?= $_SESSION["userData"]["image"] ?>" alt="Card image cap">
            <div class="card-body">
            <div class="form-group col ">
                                <label class="font-weight-bold" for="pseudo">Modifier votre pseudo</label>
                                <input type="text" class="form-control " name="pseudo" id="pseudo" aria-describedby="pseudoHelp" value="<?= $_SESSION["userData"]["pseudo"] ?>" required minlength="8" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">
                                <small id="pseudoLog" class="form-text text-muted">
                                </small>
            
                        <label class="font-weight-bold" for="email">Modifier votre email</label>
                        <input type="email" class="form-control " name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $_SESSION["userData"]["email"] ?>" required minlength="5" maxlength="40" pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})">
                        
                        <small class="form-text text-muted"></small>
                    </div>

                
                
                <button type="submit" class="btn btn-info" onclick="display2()"; >Modifier</button>
            </div>
        </div>
    </form>
    </div>

    





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="login.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>