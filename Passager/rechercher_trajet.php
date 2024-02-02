<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Rechercher un trajet</title>

        <!-- Feuilles de style Leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

        <!-- Fichier JavaScript Leaflet -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/font_awesome.js" crossorigin="anonymous"></script>

        <style>
          #map {
            height: 200px;
            margin-bottom: 10px;
          }

          #suggestions {
            list-style: none;
            padding: 0;
            margin: 0;
          }

          #suggestions li {
            cursor: pointer;
            padding: 5px;
            border: 1px solid #ccc;
            margin-bottom: 2px;
          }

          #suggestions li:hover {
            background-color: #f0f0f0;
          }

          #suggestions_arrive {
            list-style: none;
            padding: 0;
            margin: 0;
          }

          #suggestions_arrive li {
            cursor: pointer;
            padding: 5px;
            border: 1px solid #ccc;
            margin-bottom: 2px;
          }

          #suggestions_arrive li:hover {
            background-color: #f0f0f0;
          }

          #afterSearch{
            visibility: hidden;
          }
        </style>
    </head>
    <body class="sb-nav-fixed">
        
        <?php include "conn_bd.php"; ?>

        <?php include'navbar.php'; ?>

        <div id="layoutSidenav">

            <?php include'sidebar.php'; ?>

            <div id="layoutSidenav_content">
                <main id="beforeSearch">
                    <div class="container-fluid px-4">

                        <h1 class="mt-4">Rechercher un trajet</h1>
                        <hr>
                        
                        <div class="col-xl-12 col-md-12">

                          <div class="card bg-light text-dark mb-4">
                            <div class="card-body">
                              <h6><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Rechercher des trajets par les lieux de départ et d'arrivé  :</h6><br>
                              <form action="rechercher_reserver.php" method="post">    
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                      <div class="form-floating mb-3">
                                        <input class="form-control" id="addressInput" type="text"  name="lieu_dep" placeholder="Le lieu de départ"  oninput="getSuggestions(this.value)" required/>
                                        <label for="addressInput" class="text-dark">Lieu de départ</label>
                                      </div>
                                      <ul id="suggestions"></ul>
                                    </div>         
                                </div>
                                <div id="map" style="height: 400px;"></div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                      <div class="form-floating mb-3">
                                        <input class="form-control" id="inputAdressArriv" type="text" name="lieu_arr" placeholder="Le lieu d'arrivée" oninput="getSuggestions_arrive(this.value);" required/>
                                        <label for="inputAdressArriv" class="text-dark">Lieu d'arrivé</label>
                                        <ul id="suggestions_arrive"></ul>
                                      </div>
                                    </div>         
                                </div>
                                <div id="map_arriv" style="height: 400px;"></div>
                                <div class="mt-4 mb-0">
                                  <div class="d-grid"><input class="btn btn-primary btn-block" value="Rechercher" name="submit" type="submit"></div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>                       
                    </div>
                </main>
                <?php
                  if(isset($_POST['submit'])){
                    $lieu_dep = $_POST['lieu_dep'];
                    $lieu_arr = $_POST['lieu_arr'];
                  
                ?>
                <script>
                  var beforeSearchElement = document.getElementById("beforeSearch");
                  var afterSearchElement = document.getElementById("afterSearch");

                if (beforeSearchElement && afterSearchElement) {
                    //beforeSearchElement.style.visibility = "hidden";
                    afterSearchElement.style.visibility = "visible";
                } else {
                    console.error("Les éléments HTML n'ont pas été trouvés");
                }
                </script>
                <main id="afterSearch">
                    <div class="container-fluid px-4">

                        <h1 class="mt-4">Résultats de votre recherche</h1>
                        <hr>
                        
                        
                        <div class="col-xl-12 col-md-12">

                          <div class="card bg-light text-dark mb-4">
                            <div class="card-body">
                              <h6><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Les lieux de départ et d'arrivé que vous avez saisi :</h6><br>
                              <div class="col-xl-12 col-md-12">
                                <div class="card bg-secondary text-white mb-4">
                                  <div class="card-body">
                                        <form>    
                                          <div class="row mb-3">
                                              <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                  <input class="form-control" id="lieu_dep" type="text"  name="lieu_dep" value="<?php echo $lieu_dep;?>" disabled/>
                                                  <label for="addressInput" class="text-dark">Lieu de départ</label>
                                                </div>
                                                <ul id="suggestions"></ul>
                                              </div>         
                                          </div>
                                          <hr>
                                          <div class="row mb-3">
                                              <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                  <input class="form-control" id="addressInput" type="text"  name="lieu_arr" value="<?php echo $lieu_arr;?>" disabled/>
                                                  <label for="addressInput" class="text-dark">Lieu d'arrivé</label>
                                                </div>
                                              </div>         
                                          </div>
                                        </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <ul id="resultList"></ul>


                          <?php
                          
                          ?>
                          
                          <div class="card bg-light text-dark mb-4">
                            <div class="card-body">
                              <h6><i class="fa fa-car" aria-hidden="true"></i>&nbsp;&nbsp;Les trajets qui sont proches à votre recherche :</h6><br>
                              <?php
                                $today = date("Y-m-d");
                                $sql = "SELECT * FROM trajet WHERE lieu_depart='$lieu_dep' AND lieu_arrive='$lieu_arr' AND date_depart>$today";
                                $req = mysqli_query($conn,$sql);
                                $i=1;
                                while($row=mysqli_fetch_array($req)){
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
                                                $i++;}
                                                ?>
                                            </div>       
                                        </div>             
                                    </div> 
                              <?php } ?>
                            </div>
                          </div>
                        </div>                     
                    </div>
                </main>
                <?php } ?>
                <br>
                
                <?php include'footer.php'; ?>

            </div>
        </div>
        <script>
          
            // Initialisez la carte de départ

            var mymap = L.map('map').setView([36.7528, 3.0422], 13);

            // Ajoutez un fond de carte OpenStreetMap
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(mymap);

            // Ajouter un gestionnaire d'événements pour le clic sur la carte
            mymap.on('click', function (e) {
              getAddressFromCoordinates(e.latlng.lat, e.latlng.lng);
            });

            
            
            function switchAffichage() {
                var beforeSearchElement = document.getElementById("beforeSearch");
                var afterSearchElement = document.getElementById("afterSearch");

                if (beforeSearchElement && afterSearchElement) {
                    beforeSearchElement.style.display = "none";
                    afterSearchElement.style.display = "block";
                } else {
                    console.error("Les éléments HTML n'ont pas été trouvés");
                }
            }

            // Fonction pour obtenir l'adresse à partir des coordonnées
            function getAddressFromCoordinates(lat, lng) {
              // Utilisation du service de géocodage Nominatim avec protocole HTTPS
              fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                  var address = data.display_name || 'Adresse non disponible';
                  document.getElementById('addressInput').value = address;
                  markLocation(mymap, lat, lng);
                })
                .catch(error => console.error('Erreur lors de la recherche d\'adresse:', error));
            }

            
            // Fonction pour marquer l'emplacement sur la carte
            function markLocation(mymap, lat, lng) {

              mymap.setView([lat, lng], 15);
              L.marker([lat, lng]).addTo(mymap)
                .bindPopup('Votre lieu de départ !').openPopup();
            }

           

            function getSuggestions(query) {
              var suggestionsList = document.getElementById('suggestions');
              suggestionsList.innerHTML = '';

              if (query.trim() === '') {
                return;
              }

              var nominatimUrl = 'https://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + encodeURIComponent(query);

              fetch(nominatimUrl)
                .then(response => response.json())
                .then(data => {
                  data.forEach(result => {
                    var listItem = document.createElement('li');
                    listItem.textContent = result.display_name;
                    listItem.onclick = function() {
                      document.getElementById('addressInput').value = result.display_name;
                      suggestionsList.innerHTML = ''; // Efface les suggestions après la sélection
                    };
                    suggestionsList.appendChild(listItem);
                  });
                })
                .catch(error => {
                  console.error('Erreur de suggestion d\'adresse:', error);
                });
            }



             //Initizliser la carte d'arrivée
             var mymap_arr = L.map('map_arriv').setView([36.7528, 3.0422], 13);

            // Ajoutez un fond de carte OpenStreetMap
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(mymap_arr);

            // Ajouter un gestionnaire d'événements pour le clic sur la carte
            mymap_arr.on('click', function (e) {
              getAddressFromCoordinatesArr(e.latlng.lat, e.latlng.lng);
            });


            // Fonction pour obtenir l'adresse à partir des coordonnées
            function getAddressFromCoordinatesArr(lat, lng) {
              // Utilisation du service de géocodage Nominatim avec protocole HTTPS
              fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                  var address = data.display_name || 'Adresse non disponible';
                  document.getElementById('inputAdressArriv').value = address;
                  markLocationArr(mymap_arr, lat, lng);
                })
                .catch(error => console.error('Erreur lors de la recherche d\'adresse:', error));
            }

            
            // Fonction pour marquer l'emplacement sur la carte
            function markLocationArr(mymap_arr, lat, lng) {

              mymap_arr.setView([lat, lng], 15);
              L.marker([lat, lng]).addTo(mymap_arr)
                .bindPopup('Votre lieu d\'arrivée !').openPopup();
            }


            function getSuggestions_arrive(query) {
              var suggestionsList = document.getElementById('suggestions_arrive');
              suggestionsList.innerHTML = '';

              if (query.trim() === '') {
                return;
              }

              var nominatimUrl = 'https://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + encodeURIComponent(query);

              fetch(nominatimUrl)
                .then(response => response.json())
                .then(data => {
                  data.forEach(result => {
                    var listItem = document.createElement('li');
                    listItem.textContent = result.display_name;
                    listItem.onclick = function() {
                      document.getElementById('inputAdressArriv').value = result.display_name;
                      suggestionsList.innerHTML = ''; // Efface les suggestions après la sélection
                    };
                    suggestionsList.appendChild(listItem);
                  });
                })
                .catch(error => {
                  console.error('Erreur de suggestion d\'adresse:', error);
                });
            }
            


            


          
        </script>
        <script src="js/bootstrap_min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>



        <?php
          if(isset($_POST['submit_2'])){

              //remplacer les ' par des - (tirets) afin que phpMyAdmin puisse les lire 
              // a l'affichage on fait l'opération inverse

              $idCond = $_SESSION['idC'];
              $desc = ucfirst(strtolower(str_replace("'", "-", $_POST['desc'])));  
              $lieu_dep = str_replace("'", "-", $_POST['lieu_dep']);
              $date_dep = $_POST['date_dep'];
              $heure_dep = $_POST['heure_dep'];
              $lieu_arr = str_replace("'", "-", $_POST['lieu_arr']);
              $duree = $_POST['duree']; 
              $nb_sieges = $_POST['nb_sieges'];
              $prix_siege = $_POST['prix_siege'];
              $conds = ucfirst(strtolower($_POST['conds']));

              $id_traj = $_POST['idtraj'];
              $stat = $_POST['statut'];
              $nbPldisp = $_POST['nb_places_dispo'];
          
              $sql = "SELECT * FROM trajet WHERE date_depart='$date_dep' AND heure_depart='$heure_dep' AND (date_depart , heure_depart) NOT IN (SELECT date_depart , heure_depart FROM trajet WHERE idT='$id_traj')" ;
              $req = mysqli_query($conn,$sql);
              $n = mysqli_num_rows($req);
          
              if ($n > 0) {
                  ?>
                <script>
                var a = alert("Vous avez déja un trajet au même créneau que vous avez saisi maintenant");
                </script>
                <?php
              }else{
                  $s="UPDATE trajet SET descT='$desc' , statut='$stat' , lieu_depart='$lieu_dep' , date_depart='$date_dep' , heure_depart='$heure_dep' , lieu_arrive='$lieu_arr' , duree='$duree' , nb_sieges='$nb_sieges' , nb_places_dispo='$nbPldisp' , prix='$prix_siege' , conditions='$conds' , idConducteur='$idCond' WHERE idT='$id_traj'";
                  $r = mysqli_query($conn,$s);
                  if ($r){
                      ?>
                <script>
                var a = alert("Trajet modifié avec succès");
                </script>
                <?php
          
                  } else {
                      
                    echo "Error: " . $s. mysqli_error($conn);
                
                     
                
                  }
                  
          
              }
          
          }
              
        ?>
    </body>
</html>



