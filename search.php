<?php 
    if(isset($_POST['user'])&&isset($_POST['pass'])){
        try{
            $base = new PDO('mysql:host=127.0.0.1;dbname=recette', 'root', '');
            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT nom, mdp FROM login WHERE mdp like :mdp AND nom LIKE :nom";
            // Préparation de la requête avec les marqueurs
            $resultat = $base->prepare($sql);
            $resultat->execute(array('nom' => $_POST['user'],'mdp' => $_POST['pass']));
            $ligne = $resultat->fetch();
            
                if(isset($ligne['nom'])){//si le login est bon
                    $_GET['miss']=0;
                    echo '*page de recherche*';

                   
                }else{//si le login n'est pas bon
                    echo 'false';
                    header("location:log.php?miss=".($_GET['miss']+=1));
                }
                
                $resultat->closeCursor();
            }
            catch(Exception $e)
            {
                // message en cas d'erreur
                die('Erreur : '.$e->getMessage());
        }




    }else{  //si il n'y a pas le login
        echo 'false';
        header("location:log.php?miss=".($_GET['miss']+=1));
    }
    
    
    ?>