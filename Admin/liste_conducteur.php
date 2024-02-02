<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Liste des conducteurs</title>

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
                        <h1 class="mt-4">Liste des conducteurs</h1>
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
                          
                          <div class="card bg-light text-dark mb-4">
                            <div class="card-body">
                                <h6><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;&nbsp;Il existe <?php if($nb==1){echo '<b class="text-success">'.$nb." conducteur".'</b>'." qui utilise l'application WESSELNI";}else{ echo '<b class="text-success">'.$nb." conducteurs".'</b>'." qui utilisent l'application WESSELNI";} ?></h6><br>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Nom & prénom</th>
                                        <th>Matricule</th>
                                        <th>Numéro de téléphone</th>
                                        <th>Adresse</th>
                                        <th>Adresse email</th>
                                        <th>Mot de passe</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; while($row=mysqli_fetch_array($req)){?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $row['nomC']." ".$row['prenomC'];?></td>
                                        <td><?php echo $row['matriculeC'];?></td>
                                        <td><?php echo "0".$row['telC'];?></td>
                                        <td><?php echo $row['adresseC'];?></td>
                                        <th class="text-warning"><?php echo $row['emailC'];?></th>
                                        <th class="text-warning"><?php echo $row['mdpC'];?></th>
                                    </tr>
                                    <?php $i++;} ?>
                                    </tbody>
                                </table>
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
    </body>
</html>
