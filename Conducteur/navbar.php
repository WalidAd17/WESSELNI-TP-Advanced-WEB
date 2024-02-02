

<?php include "conn_bd.php"; 
$a = "SELECT * FROM propositions_trajet";
$b = mysqli_query($conn,$a);
$n = mysqli_num_rows($b);

?>


<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">
                <img src="assets/img/WESSELNI_gris.png" style="margin:45px;padding-top:5px;" width="90px;">
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="bg-dark d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" id="status_profil">
                
            <h6 class="text-success"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;<span class="text-light">Profil Conducteur : <?php echo $_SESSION['nomC']." ".$_SESSION['prenomC'];?></span></h6>
                
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profil.php">Mon profil</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="profil.php">Notifications: <?php if($n==0){echo '<b class="text-success"> 0 </b>';}else{echo '<b class="text-danger">'.$n.'</b>';}?></a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Se déconnecter</a></li>
                    </ul>
                </li>
            </ul>
        </nav>