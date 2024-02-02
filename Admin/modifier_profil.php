<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Modifier mon profil</title>
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
                        <h1 class="mt-4">Modifier mon profil</h1>
                        <hr>
                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-md-12">
                                <div class="card-body">
                                    <div class="card bg-primary text-white mb-4 mx-auto">
                                        <br>
                                        <h1 class="text-center"><i class="fa fa-user-circle" aria-hidden="true"></i></h1>
                                        <br>
                                        <?php $id = $_SESSION['idA'];
                                        $a = "SELECT * FROM admin WHERE idA='$id'";
                                        $b = mysqli_query($conn , $a);
                                        $c = mysqli_fetch_array($b);
                                        ?>
                                        
                                        <form action="modifier_profil.php" method="post" style="padding:5px;">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="inputmail" type="email" name="email" value="<?php echo $c['emailA']; ?>" required/>
                                                        <label for="inputmail" class="text-dark">Adresse email</label>
                                                    </div>
                                                </div>
                                        
                                                <div class="col-md-12">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="inputmdp" type="text" name="mdp" minlength="8" maxlength="20" value="<?php echo $c['mdpA']; ?>" required/>
                                                        <label for="inputmdp" class="text-dark">Mot de passe</label>
                                                    </div>
                                                </div>
                                                    
                                            </div> 
                                            <div class="row justify-content-center">
                                                <div class="d-grid col-md-6"><input class="btn btn-secondary btn-block" value="Valider la modification" name="confirm" type="submit"></div>
                                            </div> 
                                            <br>                              
                                        </form>
                                            
                                       

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

        <?php
            if (isset($_POST['confirm'])) {
                $mail = $_POST['email'];
                $mdp = $_POST['mdp'];
                $id = $_SESSION['idA'];
        
                $s = "UPDATE admin SET emailA='$mail' , mdpA='$mdp' WHERE idA='$id'";
                $r = mysqli_query($conn,$s);
                if ($r){
                ?>
                <script>
                var a = alert("Modification éffectuée avec succès");
                window.location ="profil.php";
                </script>
                <?php
        
                } else {
                    
                   ?>
                   <script>
                    alert("<?php echo $r.mysqli_error($conn)?>")
                   </script>
                   <?php
                  echo "Error: " . $r. mysqli_error($conn);
              
                   
              
                }
            }
        ?>
    </body>
</html>
