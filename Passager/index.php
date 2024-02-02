<?php session_start();

if ($_SESSION['idP']==null) {
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
        <title>Page d'accueil | Passager</title>
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
                            $cond = $_SESSION['idP'];
                            $sql = "SELECT * FROM trajet WHERE date_depart > '$today'";
                            $req = mysqli_query($conn,$sql);
                            $nb = mysqli_num_rows($req);
                        ?>
                        <h1 class="mt-4">Page d'accueil</h1>
                        <hr>

                        <ul class="list-group">
                            <?php
                            if($nb == 0){
                            ?>
                            <li class="list-group-item list-group-item-danger">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Il n'existe aucun trajet à proposé
                            </li>
                            <br>
                            <?php
                            }else{
                                if($nb==1){
                                    ?>
                                    <li class="list-group-item list-group-item-primary">
                                        Il existe <?php echo $nb." trajet en cours à vous proposer";?>
                                    </li>
                                    <?php
                                }else{
                                    ?>
                                    <li class="list-group-item list-group-item-primary">
                                        Il existe <?php echo $nb." trajets en cours à vous proposer";?>
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
                                                <h5 style="font-weight:bold;" class="text-dark"><i class="fa fa-car" aria-hidden="true"></i>&nbsp;&nbsp;Trajet n°<?php echo $i." :  ".'</h5>&nbsp;'.str_replace("-", "'", $row['descT']);?>
                                                <hr style="height:5px;">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td class="text-dark" style="width:16%"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;<b>Lieu de départ :</b></td>
                                                        <td><?php echo str_replace("-", "'", $row['lieu_depart']);?></td>
                                                    </tr>
                                                </table>
                                                <br>
                                                <table style="width:75%">
                                                    <tr>
                                                        <td class="text-dark" style="width:16%"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;<b>Date de départ :</b></td>
                                                        <td style="width:16%"><?php echo "Le ".'&nbsp;'.date('d / m / Y ', strtotime($row['date_depart']));?></td>
                                                        <td class="text-dark" style="width:5%"><b>à</b></td>
                                                        <td style="width:16%"><?php echo $row['heure_depart'];?></td>
                                                    </tr>
                                                </table>
                                                <hr>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td class="text-dark" style="width:16%"><i class="fa fa-map" aria-hidden="true"></i>&nbsp;&nbsp;<b>Lieu d'arrivé :</b></td>
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
                                                        <td class="text-dark" style="width:17%"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;&nbsp;<b>Prix d'un siège :</b></td>
                                                        <td><?php echo $row['prix']." DA";?></td>
        
                                                        <td class="text-dark" style="width:30%"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>&nbsp;&nbsp;<b>Nombre de sièges réservés :</b></td>
                                                        <td><?php echo ($row['nb_sieges']-$row['nb_places_dispo'])." / ".$row['nb_sieges']." places";?></td>
                                                    </tr>
                                                    <?php
                                                    $idStat = $row['statut'];
                                                    $a = "SELECT * FROM type_status WHERE idS='$idStat'";
                                                    $b = mysqli_query($conn,$a);
                                                    $c = mysqli_fetch_array($b);
                                                    ?>
                                                </table>
                                                <hr>
                                                <table class="bg-light" style="width:100%;">
                                                    <tr style="">
                                                        <td style="width:50%; padding:7px; text-align:center;" class="text-dark"><b><i class="fa fa-star"></i>&nbsp;&nbsp;STATUT DU TRAJET : &nbsp;&nbsp;</b><span class="<?php if($idStat==1){echo "text-success";}else{echo "text-danger";}?>"><b><?php echo $c['descS']?></b></span></td>    
                                                    </tr>
                                                    
                                                </table>
                                                <br>
                                                <?php 
                                                    if($idStat == 1){
                                                    ?>
                                                <form action="index.php" method="post">
                                                        <div class="row mb-3">
                                                            <div class="col-md-5">
                                                                <div class="form-floating mb-3">
                                                                    <input class="form-control" type="hidden" name="idtraj" value="<?php echo $row['idT'];?>" required/>
                                                                    <input class="form-control" id="inputNbRes" type="number" max="<?php echo $row['nb_places_dispo']; ?>" name="nb_resrv" required/>
                                                                    <label for="inputNbRes" class="text-dark">Nombre de places que vous voulez réserver</label>
                                                                </div>
                                                            </div>
                                        
                                                            <div class="col-md-7">
                                                                <div class="form-floating mb-3">
                                                                    <input class="form-control" id="inputNote" type="text" name="note" required/>
                                                                    <label for="inputNote" class="text-dark">Laissez-nous une remarque ou une note</label>
                                                                </div>
                                                            </div>
                                                    
                                                        </div>
                                                        <div class="mb-0">
                                                            <div class="d-grid"><input class="btn btn-success btn-block" value="Valider ma réservation" name="confirm" type="submit"></div>
                                                        </div>
                                                        
                                                </form>
                                                <?php
                                                }
                                                ?>
                                            </div>       
                                        </div>             
                                    </div>                 

                                    <?php $i++;  } ?>
                                </div>            
                                <?php 
                            } ?>
                                
                        </ul>
                    </div>
                </main>
                
                <?php include'footer.php'; ?>

            </div>
        </div>
        <script src="js/bootstrap_min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

        <?php if(isset($_POST['confirm'])){
                                                       
                                                       $nb_place_res = $_POST['nb_resrv'];
                                                       $note = str_replace("'", "-", $_POST['note']);

                                                       $idpassager = $_SESSION['idP'];

                                                       $idtraj = $_POST['idtraj'];

                                                       $aa = "INSERT INTO reservation (idTrajet, idPassager, nb_places_reserves, remarque) VALUES                                                         ('$idtraj', '$idpassager' , '$nb_place_res' , '$note')";
                                                       $bb = mysqli_query($conn,$aa);

                                                       if ($bb){
                                                           ?>
                                                       <script>
                                                       var a = alert("Réservation éffectuée avec succès");
                                                       window.location ="index.php";
                                                       </script>
                                                       <?php
                                               
                                                       } else {
                                                           
                                                          
                                                         echo "Error: " . $bb. mysqli_error($conn);
                                                     
                                                          
                                                     
                                                       }

                                                    } ?>
    </body>
</html>
<?php } ?>