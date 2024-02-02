<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Modifier un trajet</title>

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
        </style>
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
                        <h1 class="mt-4">Modifier un trajet</h1>
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

                          <div class="card bg-light text-dark mb-4">
                            <div class="card-body">
                              <h6><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;&nbsp;Sélectionner un trajet à modifier :</h6><br>
                              <form action="modifier_trajet.php" method="post">    
                                <div class="row mb-3">
                                    <div class="col-md-9">
                                        <select class="form-select" name="trajet_mod" aria-label="Default select example">
                                            <?php while($row=mysqli_fetch_array($req)){ ?>
                                                <option value="<?php echo $row['idT']; ?>"><?php echo $row['idT']." | ".$row['descT']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-grid"><input class="btn btn-warning btn-block" value="Confirmer" name="submit_1" type="submit"></div>
                                    </div>           
                                </div>
                                
                              </form>
                            </div>
                          </div>

                          <?php if(isset($_POST['submit_1'])){
                            
                            $traj_mod = $_POST['trajet_mod'];

                            $a="SELECT * FROM trajet WHERE idT='$traj_mod'";
                            $b=mysqli_query($conn,$a);
                            $c=mysqli_fetch_array($b);
                          ?>
                          <div class="card bg-secondary text-white mb-4">
                            <div class="card-body">
                              <form action="modifier_trajet.php" method="post">
                                            
                                            <div class="form-floating mb-3">
                                                      <input class="form-control" id="idT" type="hidden" name="idtraj" value="<?php echo $c['idT']; ?>"  />
                                                      <input class="form-control" id="statut" type="hidden" name="statut" value="<?php echo $c['statut']; ?>"  />
                                                      <input class="form-control" id="nb_places_dispo" type="hidden" name="nb_places_dispo"  value="<?php echo $c['nb_places_dispo']; ?>"/>
                                                        <input class="form-control" id="inputDesc" type="text" name="desc" placeholder="La description du trajet" value="<?php echo $c['descT']; ?>" required />
                                                        <label for="inputDesc" class="text-dark">Description du trajet</label>
                                            </div>

                                            <hr>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                            <input class="form-control" id="addressInput" type="text"  name="lieu_dep" placeholder="Le lieu de départ" value="<?php echo $c['lieu_depart']; ?>" oninput="getSuggestions(this.value)" required/>
                                                            <label for="addressInput" class="text-dark">Lieu de départ</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <h6>Propositions selon votre recherche :</h6>
                                                        <ul id="suggestions"></ul>
                                                    </div>
                                                </div>
                                          
                                            </div>

                                          
                                            <div id="result"></div>
                                            <div id="map" style="height: 400px;"></div>
                                            <br>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputdate" type="date" name="date_dep" placeholder="La date de départ" value="<?php echo $c['date_depart']; ?>" required/>
                                                        <label for="inputdate" class="text-dark">Date du départ</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputHour" type="time"  name="heure_dep" placeholder="L'heure de départ" value="<?php echo $c['heure_depart']; ?>" required />
                                                        <label for="inputHour" class="text-dark">Heure du départ</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <hr>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                      <input class="form-control" id="inputAdressArriv" type="text" name="lieu_arr" placeholder="Le lieu d'arrivée" value="<?php echo $c['lieu_arrive']; ?>" oninput="getSuggestions_arrive(this.value);" required/>
                                                      <label for="inputAdressArriv" class="text-dark">Lieu d'arrivé</label>
                                                      <ul id="suggestions_arrive"></ul>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" type="text" id="duration" name="duree" placeholder="La durée estimée" value="<?php echo $c['duree']; ?>" required>
                                                        <label for="inputHour" class="text-dark">Durée estimée</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="map_arriv" style="height: 400px;"></div>
                                            <br>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputNbSieges" type="number" name="nb_sieges" placeholder="Le nombre de sieges" value="<?php echo $c['nb_sieges']; ?>" required/>
                                                        <label for="inputNbSieges" class="text-dark">Nombre de sièges</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                      <input type="number" class="form-control" id="inputPrix" name="prix_siege" placeholder="Le prix par sieges" value="<?php echo $c['prix']; ?>" required>
                                                      <label for="inputPrix" class="text-dark">Prix par siège en DA</label>
                                                    </div>   
                                                </div>
                                                
                                            </div>

                                            <div class="form-floating mb-3">
                                              <input class="form-control" id="inputcond" type="text" name="conds" placeholder="Les conditions à respecter" value="<?php echo $c['conditions']; ?>" required/>
                                              <label for="inputcond" class="text-dark">Conditions à respecter</label>
                                            </div>

                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><input class="btn btn-primary btn-block" value="Confirmer" name="submit_2" type="submit"></div>
                                            </div>
                              </form>
                            </div>
                          </div>
                          <?php } ?>


                        </div>
                        <?php } ?>


                        
                    </div>
                </main>
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
              getAddressFromCoordinates(e.latlng.lat, e.latlng.lng);
            });


            // Fonction pour obtenir l'adresse à partir des coordonnées
            function getAddressFromCoordinates(lat, lng) {
              // Utilisation du service de géocodage Nominatim avec protocole HTTPS
              fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                  var address = data.display_name || 'Adresse non disponible';
                  document.getElementById('inputAdressArriv').value = address;
                  markLocation(mymap_arr, lat, lng);
                })
                .catch(error => console.error('Erreur lors de la recherche d\'adresse:', error));
            }

            
            // Fonction pour marquer l'emplacement sur la carte
            function markLocation(mymap_arr, lat, lng) {

              mymap_arr.setView([lat, lng], 15);
              L.marker([lat, lng]).addTo(mymap_arr)
                .bindPopup('Votre lieu de départ !').openPopup();
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



