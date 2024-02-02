<?php session_start();
if ($_SESSION['idC']==null) {
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
        <title>Trajets proposés</title>
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
                            $cond = $_SESSION['idC'];
                            $sql = "SELECT * FROM propositions_trajet WHERE date_departTemp > '$today'";
                            $req = mysqli_query($conn,$sql);
                            $nb = mysqli_num_rows($req);
                        ?>
                        <h1 class="mt-4">Les trajets proposés</h1>
                        <hr>

                        <ul class="list-group">
                            <?php
                            if($nb == 0){
                            ?>
                            <li class="list-group-item list-group-item-danger">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Il n y a aucun trajet proposé
                            </li>
                            <br>
                            <?php
                            }else{
                                if($nb==1){
                                    ?>
                                    <li class="list-group-item list-group-item-primary">
                                        Il y a <?php echo '<b>'.$nb.'</b>'." trajet proposé";?>
                                    </li>
                                    <?php
                                }else{
                                    ?>
                                    <li class="list-group-item list-group-item-primary">
                                        Il y a <?php echo '<b>'.$nb.'</b>'." trajets proposés";?>
                                    </li>
                                    <?php
                                }
                                ?>
                                <br>
                                <div class="row">
                                    <?php
                                    $i = 1;
                                    while($row = mysqli_fetch_array($req)){
                                        
                                     ?>
                                    <div class="col-xl-12 col-md-12">
                                        <div class="card bg-primary text-white mb-4">
                                            <div class="card-body">
                                                <form action="consulter_trajets_proposes_trajet.php" method="post">
                                                    <h5 style="font-weight:bold;" class="text-dark"><i>Trajet proposé n°<?php echo $i;?><br>
                                                    <hr>
                                                    <?php
                                                        $idpas = $row['idPassagerTemp'];
                                                        $aa = "SELECT * FROM passager WHERE idP='$idpas'";
                                                        $bb = mysqli_query($conn,$aa);
                                                        $cc = mysqli_fetch_array($bb);
                                                    ?>
                                                    <div class="card bg-secondary text-white mb-4">
                                                        <div class="card-body">
                                                            <div class="row mb-3">
                                                                <h5 class="text-light" style="text-align:center;">Informations du passagé</h5><br>
                                                                <br>
                                                                <input class="form-control" id="inputFullname" type="hidden" name="idpassager" value="<?php echo $cc['idP']; ?>"  readonly/>
                                                                <div class="col-md-4">
                                                                    <div class="form-floating mb-3 mb-md-0">
                                                                        <input class="form-control" id="inputFullname" type="text" name="nomcomplet" value="<?php echo $cc['nomP']." ".$cc['prenomP']; ?>" readonly/>
                                                                        <label for="inputFullname" class="text-dark">Nom & Prénom</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" id="inputTel" type="text"  name="telp" value="<?php echo "0".$cc['telP']; ?>" readonly/>
                                                                        <label for="inputTel" class="text-dark">Numéro de téléphone</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" id="inputEmail" type="text"  name="mailp" value="<?php echo $cc['emailP']; ?>" readonly/>
                                                                        <label for="inputEmail" class="text-dark">Adresse Email</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>  
                                                    </div>
                                                    <hr>
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="inputDesc" type="text" name="desc" value="<?php echo $row['descTemp']; ?>" readonly />
                                                        <label for="inputDesc" class="text-dark">Description du trajet</label>
                                                    </div>
                                                    
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="addressInput" type="text"  name="lieu_dep" value="<?php echo $row['lieu_departTemp']; ?>" readonly/>
                                                        <label for="addressInput" class="text-dark">Lieu de départ</label>
                                                    </div>
                                                        
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input class="form-control" id="inputdate" type="date" name="date_dep" value="<?php echo $row['date_departTemp']; ?>" readonly/>
                                                                <label for="inputdate" class="text-dark">Date du départ</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input class="form-control" id="inputHour" type="time"  name="heure_dep" value="<?php echo $row['heure_departTemp']; ?>" readonly/>
                                                                <label for="inputHour" class="text-dark">Heure du départ</label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <hr>

                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3 mb-md-0">
                                                                <input class="form-control" id="inputAdressArriv" type="text" name="lieu_arr" value="<?php echo $row['lieu_arriveTemp']; ?>" readonly/>
                                                                <label for="inputAdressArriv" class="text-dark">Lieu d'arrivé</label>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input class="form-control" type="text" id="duration" name="duree" value="<?php echo $row['dureeTemp']; ?>" readonly>
                                                                <label for="inputHour" class="text-dark">Durée estimée</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <input class="form-control" id="inputNbSieges" type="number" name="nb_sieges" value="<?php echo $row['nb_siegesTemp']; ?>" readonly/>
                                                                <label for="inputNbSieges" class="text-dark">Nombre de sièges</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                            <input type="number" class="form-control" id="inputPrix" name="prix_siege" value="<?php echo $row['prixTemp']; ?>" readonly/>
                                                            <label for="inputPrix" class="text-dark">Prix par siège en DA</label>
                                                            </div>   
                                                        </div>  
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="inputcond" type="text" name="conds" value="<?php echo $row['conditionsTemp']; ?>" readonly/>
                                                        <label for="inputcond" class="text-dark">Conditions à respecter</label>
                                                    </div>

                                                    <div class="mt-4 mb-0">
                                                        <div class="d-grid"><input class="btn btn-success btn-block" value="Accepter le trajet" name="submit" type="submit"></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; } ?>
                                </div>
                                <?php
                            }
                            ?>
                        </ul>
                        
                        <div>
                            <!-- si tu veut ajouter des div-->
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