<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>WESSELNI | Inscription</title>
        <link href="login_style.css" rel="stylesheet" />
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <img src="images/WESSELNI_primary.png" class="text-center" width="110px;" style="margin: 0 auto; display: block;">
                                        <h3 class="text-center font-weight-light my-3 text-primary">Créer un compte</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="check_inscrire.php">
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <select name="acteur" id="acteur"  class="form-control">
                                                            <option value="1">Passager</option>
                                                            <option value="2">Conducteur</option>
                                                        </select>
                                                        <label for="inputMatricule">Qui êtes-vous ?</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputFirstName" placeholder="Votre nom" name="nom" type="text" required />
                                                        <label for="inputFirstName">Nom</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" placeholder="Votre prénom" name="prenom" type="text" required />
                                                        <label for="inputLastName">Prénom</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">         
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputMatricule" name="mat" placeholder="Votre matricule" type="number" maxlength="12" required />
                                                        <label for="inputMatricule">Matricule d'étudiant</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputTel" name="tel" placeholder="ex: 0550123456" maxlength="10" minlength="9" required />
                                                        <label for="inputTel">Numéro de téléphone</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputAdress" name="adresse" placeholder="Votre adresse" type="text" required />
                                                        <label for="inputAdress">Adresse complète</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6 mb-md-0">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com" required/>
                                                        <label for="inputEmail">Adresse email</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" name="mdp" minlength="8" maxlength="20" type="password" placeholder="Créer un mot de passe" required/>
                                                        <label for="inputPassword">Mot de passe</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><input class="btn btn-primary btn-block" id="inputsignup" type="submit" name="submit" value="S'inscrire" required/></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="index.php">Vous avez déja un compte? Se connecter</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <br>
            <div id="layoutAuthentication_footer">
                <footer class="py-2 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; WESSELNI 2023</div>
                            <div class="text-muted">Par : &nbsp; WEB MASTERS WM</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="login_app.js"></script>
    </body>
</html>
