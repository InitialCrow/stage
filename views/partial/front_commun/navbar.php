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


        <!-- ***************************login************************************ -->
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
            <form>
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div>
                            <div class="container">
                                <div class="picture-container">
                                    <div class="picture">
                                        <img src="https://lh3.googleusercontent.com/LfmMVU71g-HKXTCP_QWlDOemmWg4Dn1rJjxeEsZKMNaQprgunDTtEuzmcwUBgupKQVTuP0vczT9bH32ywaF7h68mF-osUSBAeM6MxyhvJhG6HKZMTYjgEv3WkWCfLB7czfODidNQPdja99HMb4qhCY1uFS8X0OQOVGeuhdHy8ln7eyr-6MnkCcy64wl6S_S6ep9j7aJIIopZ9wxk7Iqm-gFjmBtg6KJVkBD0IA6BnS-XlIVpbqL5LYi62elCrbDgiaD6Oe8uluucbYeL1i9kgr4c1b_NBSNe6zFwj7vrju4Zdbax-GPHmiuirf2h86eKdRl7A5h8PXGrCDNIYMID-J7_KuHKqaM-I7W5yI00QDpG9x5q5xOQMgCy1bbu3St1paqt9KHrvNS_SCx-QJgBTOIWW6T0DHVlvV_9YF5UZpN7aV5a79xvN1Gdrc7spvSs82v6gta8AJHCgzNSWQw5QUR8EN_-cTPF6S-vifLa2KtRdRAV7q-CQvhMrbBCaEYY73bQcPZFd9XE7HIbHXwXYA=s200-no" class="picture-src" id="wizardPicturePreview" title="">
                                        <input type="file" id="wizard-picture" class="">
                                    </div>
                                    <h6 class="">Choose Picture</h6>

                                </div>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control is-valid" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Votre email...">
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control is-valid" id="Password1" placeholder="Votre mot de passe...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirmation Password</label>
                            <input type="password" class="form-control" id="Password2" placeholder="Reconfirmer votre mot de passe ...">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
            </form>





        </div>


    </div>

</div>
