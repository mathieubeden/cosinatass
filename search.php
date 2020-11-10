<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recherche nudle</title>
</head>
<body>
    <button onclick="window.location.href='./panier.php'">panier</button>
</body>
</html>

<?php 
if(isset($_SESSION['nom'])){
    echo '*page de recherche*';
    echo " bienvenu ".$_SESSION['nom'];
}elseif(isset($_POST['user'])&&isset($_POST['pass'])){
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
                    session_start();
                    $_SESSION['nom'] = $_POST['user'];
                    echo " Le nom en session est:".$_SESSION['nom'];

                   
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