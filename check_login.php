<?php session_start();

include "conn_bd.php";

// Retourner l'email + mdp from BDD selon le type de connexion (Admin , Conducteur ou Passager)

try {

    if(empty($_POST["email"]) || empty($_POST["mdp"])){  //2 ème vérification apres celle du formulaire: si les champs sont vide 
        header("location:index.php");  
    }else{ 

        //Connexion du Admin

        $sql = "SELECT * FROM admin WHERE emailA='".htmlspecialchars($_POST['email'])."' AND mdpA='".htmlspecialchars($_POST['mdp'])."' ";
        $req = mysqli_query($conn,$sql);
        $nb = mysqli_num_rows($req);
        if ($nb >0) {
                $_SESSION['useremail'] = $_POST['email'];
                $user = $_POST['email'];
                $_SESSION['usermdp'] = $_POST['mdp'];

                $profile = "SELECT *  FROM admin  WHERE emailA= '".$user."'";
                $statpros = mysqli_query($conn,$profile);
                foreach($statpros as $statpro){
                    $_SESSION['idA']= $statpro['idA'];
                    $_SESSION['emailA']= $statpro['emailA'];
                    $_SESSION['mdpA']= $statpro['mdpA'];
                }
            ?> 
            <script>window.location ="admin/index.php"</script> 
            <?php
        }else{ 

            //Connexion du conducteur
            
            $sql = "SELECT * FROM conducteur WHERE emailC='".htmlspecialchars($_POST['email'])."' AND mdpC='".htmlspecialchars($_POST['mdp'])."' ";
            $req = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($req);
            
            if ($count > 0){
                $_SESSION['useremail'] = $_POST['email'];
                $_SESSION['usermdp'] = $_POST['mdp'];
                
                $user= $_SESSION['useremail'] ;

                $var = $_SESSION['useremail'];

                $profile = "SELECT *  FROM conducteur  WHERE emailC= '".$user."'";
                $statpros = mysqli_query($conn,$profile);

                foreach($statpros as $statpro){
                    $_SESSION['idC']= $statpro['idC'];
                    $_SESSION['nomC']= $statpro['nomC'];
                    $_SESSION['prenomC']= $statpro['prenomC'];
                    $_SESSION['telC']= $statpro['telC'];
                    $_SESSION['matriculeC']= $statpro['matriculeC'];
                    $_SESSION['adresseC']= $statpro['adresseC'];
                ?>
                <script>window.location ="Conducteur/index.php"</script> 
                <?php 
                }
            }else{ 
                
                //Connexion du passager

                $sql ="SELECT * FROM passager WHERE emailP='".htmlspecialchars($_POST['email'])."' AND mdpP='".htmlspecialchars($_POST['mdp'])."' ";                
                $req = mysqli_query($conn , $sql);

                if ($req){
                   
            
                } else {
                    ?>
                    <script>
                        let a = alert("<?php echo "Error: " . $sql. mysqli_error($conn); ?>")
                    </script>
            
                    <?php
                
                    
                
                }
                $count = mysqli_num_rows($req);


                if ($count > 0){
                    $_SESSION['useremail'] = $_POST['email'];
                    $_SESSION['usermdp'] = $_POST['mdp'];
                    $user= $_SESSION['useremail'] ;

                    $var = $_SESSION['useremail'];

                    $profile = "SELECT *  FROM passager  WHERE emailP= '".$user."'";
                    $statpros = mysqli_query($conn,$profile);

                    foreach($statpros as $statpro){
                        $_SESSION['idP']= $statpro['idP'];
                        $_SESSION['nomP']= $statpro['nomP'];
                        $_SESSION['prenomP']= $statpro['prenomP'];
                        $_SESSION['telP']= $statpro['telP'];
                        $_SESSION['matriculeP']= $statpro['matriculeP'];
                        $_SESSION['adresseP']= $statpro['adresseP'];

                    ?>
                    <script>window.location ="Passager/index.php"</script> 
                    <?php 
                    }
                }else{ 
                    
                    ?> 
                    <script>
                        alert("Email ou mot de passe incorrect");
                        window.location ="index.php";
                    </script>
                    <?php 
                }
            }
        }
    }   
}
catch(PDOException $error){  
    $message = $error->getMessage();  
}
;?>