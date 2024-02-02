<?php session_start();
if ($_SESSION['idA']==null) {
    header('Location: erreur.php');
}else{

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page d'accueil | Administrateur</title>
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

                        <?php
                            $today = date("Y-m-d");
                            $sqlcond = "SELECT * FROM Conducteur";
                            $reqcond = mysqli_query($conn,$sqlcond);
                            $nbcond = mysqli_num_rows($reqcond);

                            $sqlpass = "SELECT * FROM Passager";
                            $reqpass = mysqli_query($conn,$sqlpass);
                            $nbpass = mysqli_num_rows($reqpass);

                            $sqltraj = "SELECT * FROM trajet";
                            $reqtraj = mysqli_query($conn,$sqltraj);
                            $nbtraj = mysqli_num_rows($reqtraj);

                            $sqlres = "SELECT * FROM reservation";
                            $reqres = mysqli_query($conn,$sqlres);
                            $nbres = mysqli_num_rows($reqres);
                        ?>
                        <h1 class="mt-4">Page d'accueil</h1>
                        <hr><br>
                        <div class="row">
                            <h4><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Informations générales :</h4>
                            <br><br>
                            <div class="col-xl-3 col-md-12">
                                <div class="card-body">
                                    <div class="card bg-success text-white mb-4 mx-auto" style="">
                                        <br>
                                        <p class="text-center" style="font-size:90px"><?php echo $nbcond ?></p>
                                        <h5 class="text-center"><?php if($nbcond==1){echo "Conducteur";}else{echo "Conducteurs";} ?></h5>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-12">
                                <div class="card-body">
                                    <div class="card bg-primary text-white mb-4 mx-auto">
                                        <br>
                                        <p class="text-center" style="font-size:90px"><?php echo $nbpass ?></p>
                                        <h5 class="text-center"><?php if($nbpass==1){echo "Passager";}else{echo "Passagers";} ?></h5>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-12">
                                <div class="card-body">
                                    <div class="card bg-warning text-white mb-4 mx-auto">
                                        <br>
                                        <p class="text-center" style="font-size:90px"><?php echo $nbtraj ?></p>
                                        <h5 class="text-center"><?php if($nbtraj==1){echo "Trajet proposé";}else{echo "Trajets proposés";} ?></h5>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-12">
                                <div class="card-body">
                                    <div class="card bg-danger text-white mb-4 mx-auto">
                                        <br>
                                        <p class="text-center" style="font-size:90px"><?php echo $nbres ?></p>
                                        <h5 class="text-center"><?php if($nbres==1){echo "Réservation faite";}else{echo "Réservations faites";} ?></h5>
                                        <br>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <br><hr><br>
                        <div class="row">
                            <h4><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Configuration de l'application :</h4>
                            <br><br>
                            <div class="col-xl-12 col-md-12">
                                <div class="card-body">
                                    <div class="card bg-secondary text-dark mb-4 mx-auto" style="">
                                        <br>
                                        <p class="text-center" style="font-size:90px"><?php echo $nbcond ?></p>
                                        <h5 class="text-center"><?php if($nbcond==1){echo "Conducteur";}else{echo "Conducteurs";} ?></h5>
                                        <br>
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
<?php } ?>