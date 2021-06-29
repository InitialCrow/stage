<?php
session_start();
require_once "./database.php";
$dbh = Database::connect();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

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
    <title>Reset</title>
</head>

<body>
    <?php if (isset($_GET['status']) && $_GET['status'] === "expired") : ?>
        <div class="alert alert-warning">
            <b>Session Expirée</b> Merci de vous reconnecter.
        </div>
    <?php endif;



    if (isset($_POST['recup_submit'], $_POST['recup_mail'])) {
        if (!empty($_POST['recup_mail'])) {
            $recup_mail = htmlspecialchars($_POST['recup_mail']);
            if (filter_var($recup_mail, FILTER_VALIDATE_EMAIL)) {
                $mailexist = $dbh->prepare('SELECT id FROM user where email= ?');
                $mailexist->execute([
                    $recup_mail
                ]);


                $mailexist = $mailexist->rowCount();
                if ($mailexist == 1) {
                    $_SESSION['recup_mail'] = $recup_mail;
                    $token = bin2hex(random_bytes(15));

                    $date = date("Y-m-d H:i:s", strtotime('now'));
                    $expiry = date('Y-m-d H:i:s', strtotime('now +1 Hour +30 Minutes'));
                    /*********************/



                    $req = $dbh->prepare("
                    SELECT U.email, U.pseudo, U.id as user_id, U.image , PS.pass_prefix
                    FROM user U
                    INNER JOIN pass_sal PS ON PS.user_id = U.id 
                    WHERE U.email= ?
                    LIMIT 1
                    ");
                    $req->execute([
                        $_POST["recup_mail"]
                    ]);

                    $user_id = $req->fetch();








                    $req = $dbh->prepare("
                
                
                    SELECT U.email, U.pseudo, U.id as user_id, U.image , RP.url_token, RP.date_expiry
                    FROM user U
                    INNER JOIN reset_password RP ON RP.user_id = U.id 
                    WHERE U.email= ?
                    LIMIT 1
                    ");

                    $req->execute([
                        $_POST["recup_mail"]
                    ]);

                    $url = $req->fetch();


                    $req = $dbh->prepare("INSERT INTO `reset_password` (url_token, user_id ,date_expiry) VALUES (?,?,?)");
                    $req->execute([
                        $token,
                        $user_id['user_id'],
                        $expiry,
                    ]);
                    $lien = $req->fetch();



                    /******************************************ENVOI DU MAIL********************************************************************************************** */


                    // Le message
                    $message = "Line 1\r\nLine 2\r\nLine 3";

                    // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
                    $message = wordwrap($message, 70, "\r\n");

                    // Envoi du mail
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->isSMTP();
                        $mail->Host = '127.0.0.1';
                        $mail->SMTPAuth = false;
                        $mail->SMTPAutoTLS = false;

                        $mail->Port = 1025;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('from@example.com', 'Mailer');
                        $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient


                        // //Attachments
                        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Here is the subject';
                        $mail->Body = "<a href='http://app.fr/views/changepassword.php?token=" . $token . "'>Cliquez ici</a>";
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        $mail->send();
                        echo 'Message has been sent';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }


                    /*****************************************************SESSION************************************************************* */
                    $userData = [
                        "user_id" => $user_id['user_id'],
                        "pseudo" => $user_id['pseudo'],
                        "email" => $user_id['email'],
                        "image" => $user_id['image'],
                        "date_expiry" => $expiry,
                        "url_token" => $token
                    ];
                    Database::disconnect();
                    $_SESSION['userData'] = $userData;




                    exit;
                } else {
                    echo '<div class="alert alert-danger">
                <b>Attention!</b> cette adresse mail n est pas enregistrée
                </div> ';
                }
            } else {
                echo '<div class="alert alert-danger">
                <b>Attention!</b> adresse mail invalide
                </div> ';
            }
        } else {
            echo '<div class="alert alert-danger">
                <b>Attention!</b> Veuillez entrer votre adresse mail
                </div> ';
        }
    }




















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

        <form action="" class="form-group" method="post">
            <label class="ml-2" for="reset">Merci d'inscire votre mail pour recevoir un mail de reinitialisation </label>
            <input type="email" class="form-control" id="recup_mail" name="recup_mail" placeholder="Votre email ....">
            <button type="submit" class="btn btn-primary" name="recup_submit">Envoyer</button>


        </form>



    </div>
    <?php
    require_once "./database.php";
    $dbh = Database::connect();





    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="login.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>