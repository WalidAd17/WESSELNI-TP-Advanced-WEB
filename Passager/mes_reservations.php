<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Mes réservations</title>

        <link href="assets/img/WESSELNI_bleu.png" rel="icon">

        

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
                            $moi = $_SESSION['idP'];
                            $sql = "SELECT * FROM reservation WHERE idPassager='$moi'";
                            $req = mysqli_query($conn,$sql);
                            $nb = mysqli_num_rows($req);
                        ?>
                        <h1 class="mt-4">Mes réservations</h1>
                        <hr>
                        <?php
                            if ($nb==0) {
                            ?>
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-danger">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Vous n'avez fait aucune réservation 
                                </li>
                            </ul>
                            <?php
                            }else{

                                
                        ?>
                        
                        
                        <div class="col-xl-12 col-md-12">
                          
                            
                            
                            
                            <?php
                            $i = 1;
                            while($row=mysqli_fetch_array($req)){ 
                                            
                                $traj = $row['idTrajet'];

                                $sqll = "SELECT * FROM trajet WHERE idT='$traj'";
                                $reqq = mysqli_query($conn,$sqll);

                                

                                
                                
                               

                            ?>
                                <div class="card-body">
                                      <?php
                                      $j=1;
                                      while ($roww= mysqli_fetch_array($reqq)) {
                                        $idcond = $roww['idConducteur'];
    
                                        $a="SELECT * FROM conducteur Where idC='$idcond'";
                                        $b=mysqli_query($conn,$a);
                                        $c=mysqli_fetch_array($b);

                                        $prix_tot = $row['nb_places_reserves'] * $roww['prix'];


                                      ?>
                                       
                                       <div class="card bg-secondary text-white mb-4">
                                            <div class="card-body">
                                                <h6><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;&nbsp;Reservation n° <?php echo $j;?></h6>
                                                <hr>
                                                <ul>
                                                    <li><b>Nom et prénom du Conducteur :&nbsp;&nbsp;<?php echo '<span class="text-warning">'.$c['nomC']." ".$c['prenomC'].'</span>';?> &nbsp;&nbsp;|&nbsp;&nbsp; Numéro du téléphone : <?php echo '<span class="text-warning">'.$c['telC'].'</span>';?></b></li>
                                                    <hr>
                                                    <li>
                                                        <b>Informations sur le trajet :</b><br>
                                                    </li>
                                                    <div style="border: 3px inset black; padding:5px; margin:10px 0px; width:97%;">
                                                        <table style="width:100%">
                                                            <tr>
                                                                <th class="text-dark" style="width:20%"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;Lieu de départ :</th>
                                                                <td class="text-warning"><?php echo str_replace("-", "'", $roww['lieu_depart']);?></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-dark"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Date de départ :</th>
                                                                <td class="text-warning"><?php echo "Le ".'&nbsp;'.date('d / m / Y ', strtotime($roww['date_depart'])).'&nbsp;&nbsp;<b style="color:black;">'." à ".'</b>&nbsp;&nbsp;'.$roww['heure_depart'];?></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-dark"><i class="fa fa-map" aria-hidden="true"></i>&nbsp;&nbsp;Lieu d'arrivée :</th>
                                                                <td class="text-warning"><?php echo str_replace("-", "'", $roww['lieu_arrive']);?></td>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-dark"><i class="fa fa-clock" aria-hidden="true"></i>&nbsp;&nbsp;Durée estimée :</th>
                                                                <td class="text-warning"><?php echo $roww['duree'];?></td>
                                                            </tr>
                                                        </table>
                                                        <table style="width:100%">
                                                            <tr>
                                                                <th class="text-dark" style="width:30%"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>&nbsp;&nbsp;Nombre de sièges réservés :</th>
                                                                <td class="text-warning"><?php if($row['nb_places_reserves']==1){echo $row['nb_places_reserves']." place";}else{echo $row['nb_places_reserves']." places";}?></td>
                                                            </tr>
                                                            </table>
                                                        <table style="width:100%">
                                                            <tr>
                                                                <th class="text-dark" style="width:20%"><i class="fa fa-commenting" aria-hidden="true"></i>&nbsp;&nbsp;Votre remarque :</th>
                                                                <td class="text-warning"><?php echo str_replace("-", "'", $row['remarque']);?></td>
                                                            </tr>
                                                            
                                                        </table>
                                                    </div>
                                                   
                                                    
                                                    <hr>
                                                    <li class="text-center text-primary" style="list-style:none;"><span class="btn btn-light btn-block"><b>Prix total de la réservation :&nbsp;&nbsp;<?php echo '<span class="text-success">'.$prix_tot." DA".'</span>';?></b></span></li>
                                                </ul>
                
                                            </div>
                                        </div>

                                       <?php $j++; } ?>
                                
                                </div>

                            <?php $i++; } ?>

                        </div>
                        <?php }?>


                        
                    </div>
                </main>
                <br>
                
                <?php include'footer.php'; ?>

            </div>
        </div>
        
        <script src="js/bootstrap_min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

        <?php
          if(isset($_POST['submit'])){
              $idTraj = $_POST['trajet'];
            
              $s = "DELETE FROM trajet WHERE idT='$idTraj'"; 
              $r = mysqli_query($conn,$s);
              if ($r){
                      ?>
                <script>
                var a = alert("Trajet annulé avec succès");
                window.location ="index.php";
                </script>
                <?php
              } else {
                    echo "Error: " . $s. mysqli_error($conn);
              }
                  
          }   
        ?>
    </body>
</html>
