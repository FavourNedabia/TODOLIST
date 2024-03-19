<?php
session_start();
require "connexion.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    //Recuperer les produits
    $sql = "SELECT * From todos where id = :id";
    //Preparation de la requete
    $requete = $dbb -> prepare($sql);
    $requete->bindParam(":id", $id);
    $requete->execute();
    if($requete ->rowCount() ==1){ 
        $todo = $requete ->fetch(PDO::FETCH_ASSOC);
     } else
     {
        $erreurr= "Aucune information trouvé";
        $_SESSION['error']= $erreurr;
        header("location: create.php");
    }
     //
}
else
{
    header("location: create.php");
   
}


?>



<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Taches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container my-5">
        <div class="col-md-8 mx-auto">
            <div class="card shadow p-5">
                <h3 class="mb-3">Tâche à faire
                    <a href="index.php" class="btn btn-outline-danger btn-sm float-end">Retour</a>
                </h3>
                
                    <div class="mb-3">
                        <input type="text" name="task" readonly placeholder="Tâche" value="<?= $todo['task']?? '' ?>" class="form-control" id="">
                        
                    </div>
                    <div class="mb-3">
                    <textarea name="description" readonly id="" cols="30" rows="3" class="form-control" placeholder="La description "><?= $todo['description']?? '' ?></textarea>
                        
                    </div>
               
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>