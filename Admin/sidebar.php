<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <br>
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Page d'accueil
                            </a>
                            <div class="sb-sidenav-menu-heading">Gestion des utilisateurs</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsConducteurs" aria-expanded="false" aria-controls="collapseLayoutsConducteurs">
                                <div class="sb-nav-link-icon"><i class="fa fa-cog"></i></div>
                                Les conducteurs
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsConducteurs" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="bloquer_conducteur.php"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;Bloquer</a>
                                    <a class="nav-link" href="liste_conducteur.php"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;Liste conducteurs</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsPassagers" aria-expanded="false" aria-controls="collapseLayoutsPassagers">
                                <div class="sb-nav-link-icon"><i class="fa fa-cog"></i></div>
                                Les passagers
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsPassagers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="bloquer_passager.php"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;Bloquer</a>
                                    <a class="nav-link" href="liste_passager.php"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;Liste passagers</a>
                                </nav>
                            </div>
                           

                            <div class="sb-sidenav-menu-heading">Configuration</div>
                            <a class="nav-link" href="voir_reservation.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                La géolocalisation
                            </a>
                            <br>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
                                Se déconnecter
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Fait par:</div>
                        L'équipe Web Masters
                    </div>
                </nav>
            </div>