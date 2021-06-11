<div class="card mx-auto  " style="width:50vw;">
    <ul class="nav nav-tabs " id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>



        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Inscription</a>
        </li>

    </ul>


    <div class="tab-content mx-5 mt-2 mb-2" id="myTabContent">


        <!-- ***************************login**********************************************************************************************************-->
        <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="home-tab">
            <form>

                <div class="form-group ">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" class="form-control " id="pseudo" aria-describedby="pseudoHelp" placeholder="Votre pseudo..." required minlength="5" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">
                    <small id="pseudoLog" class="form-text text-muted">Votre pseudo doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres, et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.
                    </small>
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="Password1" placeholder="Votre mot de passe..." required minlength="8" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">
                    <small id="passwordlog" class="form-text text-muted">Votre mot de passe doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres, et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.
                    </small>
                </div>
                <div class="etc-login-form">
                    <p>mot de passe oublie ? <a href="#"><i class="fas fa-lock fa-lg"></i></a></p>

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>


        <!-- ******************************inscription**************************************** -->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form id="inscription">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div>

                            <div class="row d-flex">
                                <div class="form-group col ">
                                    <label for="pseudo">Pseudo</label>
                                    <input type="text" class="form-control " id="pseudo" aria-describedby="pseudoHelp" placeholder="Votre pseudo..." required minlength="8" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">
                                    <small id="pseudoLog" class="form-text text-muted">Votre pseudo doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres, et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.
                                    </small>
                                </div>

                                <div class=" d-flex justify-content-center col   " id="profile-container ">
                                    <img class="mx-auto" id="profileImage" src="https://www.icone-png.com/png/48/48154.png" />
                                </div>
                                <input id="imageUpload" type="file" placeholder="Photo" required="" capture>

                            </div>


                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Votre email..." required minlength="5" maxlength="40" pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})">
                        <small class="form-text text-muted"></small>
                    </div>

                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" id="Password" name="Password" placeholder="confirmer votre mot de passe ..." required minlength="8" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">
                        <small class="form-text text-muted">Votre mot de passe doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres, et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.</small>
                    </div>
                    <div class="form-group">
                        <label for="Password2">Confirmation Password</label>
                        <input type="password" class="form-control" id="Password2" name="Password2" placeholder="Reconfirmer votre mot de passe ..." required minlength="8" maxlength="20" pattern="^\W*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$">

                        <p id="success"></p>
                        <p id="erreur"></p>

                    </div>

                    <button type="submit" class="btn btn-primary" onclick="verif()">Submit</button>

            </form>

        </div>


    </div>


</div>