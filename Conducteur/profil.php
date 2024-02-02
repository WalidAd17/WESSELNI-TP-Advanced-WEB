<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Mon profil</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/font_awesome.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        
        <?php include "conn_bd.php"; ?>

        <?php include'navbar.php'; ?>

        <div id="layoutSidenav">

            <?php include'sidebar.php'; ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Mon profil</h1>
                        <hr>
                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-md-12">
                                <div class="card-body">
                                    <div class="card bg-primary text-white mb-4 mx-auto">
                                        <br>
                                        <h1 class="text-center"><i class="fa fa-user-circle" aria-hidden="true"></i></h1>
                                        <br>
                                        <?php $id = $_SESSION['idC'];
                                            $a = "SELECT * FROM conducteur WHERE idC='$id'";
                                            $b = mysqli_query($conn , $a);
                                            $c = mysqli_fetch_array($b);
                                            ?>

                                        <ul style="list-style-type:none;">
                                            <li><h5><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Nom & Prénom :&nbsp;&nbsp;&nbsp;<?php echo '<span class="text-dark">'.$c['nomC']." ".$c['prenomC'].'</span>';?></h5></li>
                                            <li><h5><i class="fa fa-id-card" aria-hidden="true"></i>&nbsp;&nbsp;Matricule :&nbsp;&nbsp;&nbsp;<?php echo '<span class="text-dark">'.$c['matriculeC'].'</span>';?></h5></li>
                                            <hr style="width:93%">
                                            <li><h5><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;Numéro de téléphone :&nbsp;&nbsp;&nbsp;<?php echo '<span class="text-dark">'."0".$c['telC'].'</span>';?></h5></li>
                                            <li><h5><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;Adresse :&nbsp;&nbsp;&nbsp;<?php echo '<span class="text-dark">'.$c['adresseC'].'</span>';?></h5></li>
                                        </ul>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="card-body">
                                                <div class="card bg-dark text-white mb-4 mx-auto">
                                                    <ul style="list-style-type:none;">
                                                        <br>
                                                        <li><h5><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Adresse email :&nbsp;&nbsp;&nbsp;<?php echo '<span class="text-warning">'.$c['emailC'].'</span>';?></h5></li>
                                                        <li><h5><i class="fa fa-unlock-alt" aria-hidden="true"></i></i>&nbsp;&nbsp;Mot de passe :&nbsp;&nbsp;&nbsp;<?php echo '<span class="text-warning">'.$c['mdpC'].'</span>';?></h5></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                
                <?php include'footer.php'; ?>

            </div>
        </div>
        <script src="js/bootstrap_min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

    </body>
</html>
