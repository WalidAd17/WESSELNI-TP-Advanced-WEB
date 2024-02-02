<?php session_start();

include "conn_bd.php"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Résultats de votre recherche</title>

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

                        <h1 class="mt-4"><i  onclick="history.back()" class="fa fa-arrow-circle-left" aria-hidden="true"></i>&nbsp;Résultats de votre recherche</h1>
                        <hr>
                        <?php
                          if(isset($_POST['submit'])){
                            $lieu_dep = $_POST['lieu_dep'];
                            $lieu_arr = $_POST['lieu_arr'];
                          
                        ?>
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
                          
                          <div class="card bg-light text-dark mb-4">
                            <div class="card-body">
                              <h6><i class="fa fa-car" aria-hidden="true"></i>&nbsp;&nbsp;Les trajets qui sont proches à votre recherche :</h6><br>
                              <?php
                                $today = date("Y-m-d");
                                $dep = str_replace("'", "-", $lieu_dep);
                                $arr = str_replace("'", "-", $lieu_arr);
                                $sql = "SELECT * FROM trajet WHERE lieu_depart='$dep' AND lieu_arrive='$arr' AND date_depart > '$today'";
                                $req = mysqli_query($conn,$sql);
                                
                                $i=1;
                                if(mysqli_num_rows($req)==0){
                                  ?>
                                  <div class="col-xl-12 col-md-12">
                                        <div class="card bg-danger text-white mb-4">
                                            <div class="card-body">
                                              <h5><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;Aucun trajet correspondant à votre recherche n'a été trouvé. Essayez un autre lieu de départ/arrivée.</h5>
                                              
                                            </div>
                                            
                                        </div>
                                        <a href="proposer_trajet.php" style="text-decoration:none;">
                                          <div class="card col-xl-4 bg-primary text-white mb-4">
                                              <div class="card-body">
                                                <h5><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp;Proposer le aux conducteurs !</h5>
                                                
                                              </div>
                                          </div>
                                        </a>
                                        
                                        <h6 style="cursor:pointer;" onclick="history.back()" class="mt-4 text-dark"><i class="fa fa-arrow-circle-left text-dark" aria-hidden="true"></i>&nbsp;Revenir</h6>
                                  </div>
                                  <?php
                                }else {

                                

                                while($row=mysqli_fetch_array($req)){
                  
                              ?>
                              <div class="col-xl-12 col-md-12">
                                        <div class="card bg-success text-white mb-4">
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
                                                <form action="rechercher_reserver.php" method="post">
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
                              <?php } }?>
                            </div>
                          </div>
                        </div>  
                        <?php }else{
                          ?>
                          <script>
                            alert("Vous n'avez rien saisi");
                            history.back();
                          </script>
                          <?php
                        } ?>                     
                    </div>
                </main>
                <br>
                
                <?php include'footer.php'; ?>

            </div>
        </div>
        <script>
          
           
            

           

            
            
            

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



            // Fonction pour obtenir les lieux proches à partir d'une adresse et les afficher

            async function getNearbyPlacesAndDisplay() {
                var address = document.getElementById("lieu_dep").value;
                alert(address);

                if (!address.trim()) {
                    console.error('Adresse vide');
                    return;
                }

                var nominatimUrl = 'https://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + encodeURIComponent(address);

                try {
                    var response = await fetch(nominatimUrl);
                    var data = await response.json();
                    //var x = document.getElementById("essai");

                    var places = data.map(result => {
                        return {
                            display_name: result.display_name,
                            lat: result.lat,
                            lon: result.lon
                        };
                    });

                    //x.innerHTML('Lieux proches:', places);
                    // Faites quelque chose avec la liste des lieux proches, par exemple, affichez-les dans une liste.
                    displayPlaces(places);
                } catch (error) {
                    console.error('Une erreur s\'est produite:', error);
                }
            }

            // Fonction pour afficher les lieux proches
            function displayPlaces(places) {
                // Effacez le contenu précédent (à adapter selon vos besoins)
                var resultList = document.getElementById('resultList');
                resultList.innerHTML = '';

                places.forEach(place => {
                    var listItem = document.createElement('li');
                    listItem.textContent = place.display_name;
                    resultList.appendChild(listItem);
                });
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



        <?php if(isset($_POST['confirm'])){
                                                       
          $nb_place_res = $_POST['nb_resrv'];
          $note = str_replace("'", "-", $_POST['note']);

          $idpassager = $_SESSION['idP'];

           $idtraj = $_POST['idtraj'];

          $aa = "INSERT INTO reservation (idTrajet, idPassager, nb_places_reserves, remarque) VALUES ('$idtraj', '$idpassager' , '$nb_place_res' , '$note')";
          $bb = mysqli_query($conn,$aa);

          if ($bb){
           ?>
            <script>
                  var a = alert("Réservation éffectuée avec succès");
                  window.location ="rechercher_trajet.php";
            </script>
           <?php
                                               
          } else {                                                                                                                  
            echo "Error: " . $bb. mysqli_error($conn);
          }
        } ?>
    </body>
</html>



