<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Annuler un trajet</title>

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
                            $sql = "SELECT * FROM trajet WHERE idConducteur='$cond' AND date_depart>$today";
                            $req = mysqli_query($conn,$sql);
                            $nb = mysqli_num_rows($req);
                        ?>
                        <h1 class="mt-4">Annuler un trajet</h1>
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
                          
                          <div class="card bg-secondary text-white mb-4">
                            <div class="card-body">
                            <h6><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;&nbsp;Sélectionner un trajet à annuler :</h6><br>
                              <form action="annuler_trajet.php" method="post">
                                            
                                <select class="form-select" name="trajet" aria-label="Default select example">
                                    <?php while($row=mysqli_fetch_array($req)){ ?>
                                        <option value="<?php echo $row['idT']; ?>"><?php echo $row['idT']." | ".$row['descT']; ?></option>
                                    <?php } ?>
                                </select>

                                <div class="mt-4 mb-0">
                                    <div class="d-grid"><input class="btn btn-danger btn-block" value="Confirmer" name="submit" type="submit"></div>
                                </div>
                              </form>
                            </div>
                          </div>
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
