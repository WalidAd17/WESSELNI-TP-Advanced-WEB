<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Voir les réservations</title>

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
                            $cond = $_SESSION['idC'];
                            $sql = "SELECT * FROM trajet WHERE idConducteur='$cond' AND date_depart>'$today'";
                            $req = mysqli_query($conn,$sql);
                            $nb = mysqli_num_rows($req);
                        ?>
                        <h1 class="mt-4">Consulter les réservations actuelles</h1>
                        <hr>
                        <?php
                            if ($nb==0) {
                            ?>
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-danger">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Vous n'avez aucun traget  en cours
                                </li>
                            </ul>
                            <?php
                            }else{

                                
                        ?>
                        
                        
                        <div class="col-xl-12 col-md-12">
                          
                            
                            <?php
                            $i = 1;
                            while($row=mysqli_fetch_array($req)){ 
                                            
                                $traj = $row['idT'];
                                $sqll = "SELECT * FROM reservation WHERE idTrajet='$traj'";
                                $reqq = mysqli_query($conn,$sqll);

                                $nb_reserv = mysqli_num_rows($reqq);
                                
                                
                               

                            ?>
                            
                            <div class="card bg-info text-white mb-4">
                                <div class="card-body">
                                <h5 class="text-dark"><i class="fa fa-car" aria-hidden="true"></i>&nbsp;&nbsp;<u>Trajet n° <?php echo $i;?> :</u>&nbsp; <?php echo $row['descT']; ?></h5><br>
                                <h5 class="btn btn-light btn-block">Nombre de sièges totale : <?php echo $row['nb_sieges']; ?></h5>
                                      <?php
                                      $j=1;
                                      while ($roww= mysqli_fetch_array($reqq)) {
                                        $idpassag = $roww['idPassager'];
    
                                        $a="SELECT * FROM passager Where idP='$idpassag'";
                                        $b=mysqli_query($conn,$a);
                                        $c=mysqli_fetch_array($b);

                                        $prix_tot = $roww['nb_places_reserves'] * $row['prix'];


                                      ?>
                                       
                                       <div class="card bg-secondary text-white mb-4">
                                            <div class="card-body">
                                                <h6><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;&nbsp;Reservation n° <?php echo $j;?></h6>
                                                <hr>
                                                <ul>
                                                    <li><b>Nom et prénom du passager :&nbsp;&nbsp;<?php echo '<span class="text-warning">'.$c['nomP']." ".$c['prenomP'].'</span>';?> &nbsp;&nbsp;|&nbsp;&nbsp; Numéro du téléphone : <?php echo '<span class="text-warning">'.$c['telP'].'</span>';?></b></li>
                                                    <br>
                                                    <li><b>Nombre de places réservés :&nbsp;&nbsp;<?php echo '<span class="text-warning">'.$roww['nb_places_reserves']." places".'</span>';?></b></li>
                                                    <br>
                                                    <li><b>Remarque du passager :&nbsp;&nbsp;<?php echo '<span class="text-warning">'.$roww['remarque'].'</span>';?></b></li>
                                                    <hr>
                                                    <li class="text-center text-primary" style="list-style:none;"><span class="btn btn-light btn-block"><b>Prix total de la réservation :&nbsp;&nbsp;<?php echo '<span class="text-success">'.$prix_tot." DA".'</span>';?></b></span></li>
                                                </ul>
                
                                            </div>
                                        </div>

                                       <?php $j++; } ?>
                                
                                </div>
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
