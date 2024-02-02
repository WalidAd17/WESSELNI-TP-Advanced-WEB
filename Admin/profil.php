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
                        <?php $id = $_SESSION['idA'];
                        $a = "SELECT * FROM admin WHERE idA='$id'";
                        $b = mysqli_query($conn , $a);
                        $c = mysqli_fetch_array($b);
                        ?>
                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-md-12">
                                <div class="card-body">
                                    <div class="card bg-primary text-white mb-4 mx-auto">
                                        <br>
                                        <h1 class="text-center"><i class="fa fa-user-circle" aria-hidden="true"></i></h1>
                                        <br>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="card-body">
                                                <div class="card bg-dark text-white mb-4 mx-auto">
                                                    <ul style="list-style-type:none;">
                                                        <br>
                                                        <li><h5><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Adresse email :&nbsp;&nbsp;&nbsp;<?php echo '<span class="text-warning">'.$c['emailA'].'</span>';?></h5></li>
                                                        <li><h5><i class="fa fa-unlock-alt" aria-hidden="true"></i></i>&nbsp;&nbsp;Mot de passe :&nbsp;&nbsp;&nbsp;<?php echo '<span class="text-warning">'.$c['mdpA'].'</span>';?></h5></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-xl-4 col-md-12">
                                                <div class="card-body">
                                                    <div class="card bg-light text-dark mb-4 mx-auto">
                                                        <button onClick="window.location.href='modifier_profil.php'" type="button" class="btn btn-default">Modifier</button>   
                                                    </div>
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
