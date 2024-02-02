<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Historique des trajets</title>
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
                            $sql = "SELECT * FROM trajet WHERE idConducteur='$cond' AND date_depart<'$today'";
                            $req = mysqli_query($conn,$sql);
                            $nb = mysqli_num_rows($req);
                        ?>
                        <h1 class="mt-4">Historique des trajets</h1>
                        <hr>

                        <ul class="list-group">
                            <?php
                            if($nb == 0){
                            ?>
                            <li class="list-group-item list-group-item-danger">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Vous n'avez proposé aucun trajet
                            </li>
                            <br>
                            <?php
                            }else{
                                if($nb==1){
                                    ?>
                                    <li class="list-group-item list-group-item-primary">
                                        Vous avez proposé <?php echo $nb." trajet";?>
                                    </li>
                                    <?php
                                }else{
                                    ?>
                                    <li class="list-group-item list-group-item-primary">
                                        Vous avez proposé <?php echo $nb." trajets";?>
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
                                        <div class="card bg-info text-seondary mb-4">
                                            <div class="card-body">
                                                <h5 style="font-weight:bold;" class="text-dark"><i>Trajet n°<?php echo $i.'</i>'." :  ".'</h5>&nbsp;'.str_replace("-", "'", $row['descT']);?>
                                                <hr style="height:5px;">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td class="text-dark" style="width:15%"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;<b>Lieu de départ :</b></td>
                                                        <td><?php echo str_replace("-", "'", $row['lieu_depart']);?></td>
                                                    </tr>
                                                </table>
                                                <br>
                                                <table style="width:50%">
                                                    <tr>
                                                        <td class="text-dark" style="width:15%"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;<b>Date de départ :</b></td>
                                                        <td style="width:15%"><?php echo "Le ".'&nbsp;'.date('d / m / Y ', strtotime($row['date_depart']));?></td>
                                                        <td class="text-dark" style="width:5%"><b>à</b></td>
                                                        <td style="width:15%"><?php echo $row['heure_depart'];?></td>
                                                    </tr>
                                                </table>
                                                <hr>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td class="text-dark" style="width:15%"><i class="fa fa-map" aria-hidden="true"></i>&nbsp;&nbsp;<b>Lieu d'arrivé :</b></td>
                                                        <td><?php echo str_replace("-", "'", $row['lieu_arrive']);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-dark" style="width:15%"><i class="fa fa-clock" aria-hidden="true"></i>&nbsp;&nbsp;<b>Durée estimée :</b></td>
                                                        <td><?php echo $row['duree'];?></td>
                                                    </tr>
                                                </table>
                                                <hr>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td class="text-dark" style="width:17%"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;&nbsp;<b>Prix d'un sièges :</b></td>
                                                        <td><?php echo $row['prix']." DA";?></td>
        
                                                        <td class="text-dark" style="width:25%"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>&nbsp;&nbsp;<b>Nombre de sièges réservés :</b></td>
                                                        <td><?php echo ($row['nb_sieges']-$row['nb_places_dispo'])." / ".$row['nb_sieges']." places";?></td>
                                                    </tr>
                                                    <?php
                                                    $idStat = $row['statut'];
                                                    $a = "SELECT * FROM type_status WHERE idS='$idStat'";
                                                    $b = mysqli_query($conn,$a);
                                                    $c = mysqli_fetch_array($b);
                                                    ?>
                                                </table>
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
