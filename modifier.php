<?php
session_start();

require "connexion.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "SELECT * FROM todos WHERE id = :id";
    $requete = $dbb->prepare($sql);
    $requete->bindParam(":id", $id);
    $requete->execute();
    
    
    if($requete->rowCount() == 1){ 
        $todo = $requete->fetch(PDO::FETCH_ASSOC);
    } else {
        $error = "Aucune information trouvée";
        $_SESSION['error'] = $error;
        header("location: index.php");
    }
}







//erreur 
if(isset($_SESSION["error"])){
    $erreur = $_SESSION["error"];
    if(isset($erreur['task'])){
        $erreur_task = $erreur['task'];
    }
    if(isset($erreur['description'])){
        $erreur_description = $erreur['description'];
    }
}
//donnée
if(isset($_SESSION["data"])){
    $data = $_SESSION["data"];
    if(isset($data['task'])){
        $task=$data['task'];
    }
    if(isset($data['description'])){
        $description = $data['description'];
    }
}
unset($_SESSION['data']);
unset($_SESSION['error']);

?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ModifierTaches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container my-5">
        <div class="col-md-8 mx-auto">
            <div class="card shadow p-5">
                <h3 class="mb-3">Tâche à faire
                <a href="index.php" class="btn btn-outline-danger btn-sm float-end">Retour</a>
                </h3>
                
                <form action="validation.php" method="post">
                    <div class="mb-3">
                        <input type="text" name="task" placeholder="Tâche" value="<?= $todo['task']?>" class="form-control" id="">
                        <span class="text-danger"><i><?= $error_task?? '' ?></i></span>
                    </div>
                    <div class="mb-3">
                    <textarea name="description" id="" cols="30" rows="3" class="form-control" placeholder="La description "><?= $todo['description']?></textarea>
                        <span class="text-danger"><i><?= $error_description?? '' ?></i></span>
                    </div>
                    <input type="hidden" name="id" value="<?= $todo['id']?? '' ?>" id="">
                    
                    <button class="btn btn-primary w-100" type="submit" name="update">Modifier</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>