<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>WESSELNI | Connexion</title>
        <link href="login_style.css" rel="stylesheet" />
        <!-- lien vers font_awsome -->
        <style>
            #inputRememberPassword{
                border-radius:50%;
                width:20px;
                height:15px;
            }
        </style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header" style="text-align: center;">
                                        <img src="images/WESSELNI_primary.png" class="text-center" width="110px;" style="margin: 0 auto; display: block;">
                                        <h3 class="text-center font-weight-light my-4 text-primary">Se connecter</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="check_login.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com" required/>
                                                <label for="inputEmail">Adresse email</label>
                                            </div>
                                    
                                            <div class="form-floating mb-2">
                                                <input class="form-control" id="inputPassword" name="mdp" type="password" minlength="8" maxlength="20" placeholder="Password" required/>
                                                <label for="inputPassword">Mot de passe</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Afficher Mot de passe</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html" style=" text-decoration:none;">Mot de passe oublié</a>
                                                <input class="btn btn-primary btn-block" id="inputlogin" type="submit" name="submit" value="Se connecter" required/>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="inscrire.php" style=" text-decoration:none;">Vous n'avez pas un compte? S'inscrire!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
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
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var inputPassword = document.getElementById("inputPassword");
                var inputRememberPassword = document.getElementById("inputRememberPassword");

                inputRememberPassword.addEventListener("change", function() {
                    if (inputRememberPassword.checked) {
                        inputPassword.setAttribute("type", "text");
                    } else {
                        inputPassword.setAttribute("type", "password");
                    }
                });
            });
        </script>
    </body>
</html>
