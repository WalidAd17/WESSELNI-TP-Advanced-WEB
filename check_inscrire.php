<?php session_start();

include "conn_bd.php";

if (isset($_POST['submit'])) {
    $acteur = $_POST['acteur'];
    $nom = strtoupper($_POST['nom']);
    $prenom = ucfirst(strtolower($_POST['prenom']));
    $matricule = $_POST['mat'];
    $tel = $_POST['tel'];
    $adresse = str_replace("'", "-",$_POST['adresse']);
    $mail = $_POST['email'];
    $mdp = $_POST['mdp'];

    if ($acteur == 1) { //passager
        $sql = "SELECT * FROM passager WHERE matriculeP='$matricule' OR emailP='$mail'";
        $req = mysqli_query($conn , $sql);
        $nb = mysqli_num_rows($req);
        if ($nb>0) {
            ?>
            <script>
                alert("Oops, Compte existe déja");
                window.location ="inscrire.php";
            </script>
            <?php   
        }else {
            $sql2 = "INSERT INTO passager(nomP, prenomP, telP, adresseP, matriculeP, emailP, mdpP) VALUES ('$nom','$prenom','$tel','$adresse','$matricule','$mail','$mdp')";
            $req2 = mysqli_query($conn,$sql2);
            if ($req2){
                ?>
                <script>
                    var a = alert("Compte passager créée avec succès");
                    window.location ="index.php";
                </script>
                <?php
            } else {
                echo "Error: " . $sql2. mysqli_error($conn);
            }
        }
    }elseif ($acteur == 2) {  //conducteur
        $sql = "SELECT * FROM conducteur WHERE matriculeC='$matricule' OR emailC='$mail'";
        $req = mysqli_query($conn , $sql);
        $nb = mysqli_num_rows($req);
        if ($nb>0) {
            ?>
            <script> 
                alert("Oops, Compte existe déja");
                window.location ="inscrire.php";
            </script>
            <?php   
        }else {
            $sql2="INSERT INTO conducteur(nomC, prenomC, telC, adresseC, matriculeC, emailC, mdpC) VALUES ('$nom','$prenom','$tel','$adresse','$matricule','$mail','$mdp')";
            $req2=mysqli_query($conn,$sql2);
            if ($req2){
                ?>
                <script>
                    var a = alert("Compte conducteur créée avec succès");
                    window.location ="index.php";
                </script>
                <?php
            } else {
                echo "Error: " . $sql2. mysqli_error($conn);
            }

        }
    }
}

?>