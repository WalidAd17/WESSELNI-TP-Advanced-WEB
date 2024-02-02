<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bloquer un conducteur</title>

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
                            $sql = "SELECT * FROM conducteur";
                            $req = mysqli_query($conn,$sql);
                            $nb = mysqli_num_rows($req);
                        ?>
                        <h1 class="mt-4">Bloquer un conducteur</h1>
                        <hr>
                        <?php
                            if ($nb==0) {
                            ?>
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-danger">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Il n'existe aucun conducteur
                                </li>
                            </ul>
                            <?php
                            }else{
                        ?>
                        
                        
                        <div class="col-xl-12 col-md-12">
                          
                          <div class="card bg-secondary text-white mb-4">
                            <div class="card-body">
                            <h6><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;&nbsp;Sélectionner un conducteur à bloquer :</h6><br>
                              <form action="annuler_trajet.php" method="post">
                                            
                                <select class="form-select" name="cond" aria-label="Default select example">
                                    <?php while($row=mysqli_fetch_array($req)){ ?>
                                        <option value="<?php echo $row['idC']; ?>"><?php echo $row['idC']." | ".$row['nomC']." ".$row['prenomC']; ?></option>
                                    <?php } ?>
                                </select>

                                <div class="mt-4 mb-0">
                                    <div class="d-grid"><input class="btn btn-danger btn-block" value="Bloquer" name="submit" type="submit"></div>
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
              $idcond = $_POST['cond'];
            
              $s = "DELETE FROM conducteur WHERE idC='$idcond'"; 
              $r = mysqli_query($conn,$s);
              if ($r){
                      ?>
                <script>
                var a = alert("Conducteur bloqué avec succès");
                window.location ="liste_conducteur.php";
                </script>
                <?php
              } else {
                    echo "Error: " . $s. mysqli_error($conn);
              }
                  
          }   
        ?>
    </body>
</html>
