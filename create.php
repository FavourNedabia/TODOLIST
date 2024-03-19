<!-- create.php -->
<?php
session_start();
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma To-Do List</title>
    <!-- Incluez Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="col-md-7 mx-auto">
        <h1>Mes taches</h1>
            <div class="card shadow p-5">
            <form action="validation.php" method="post">
                <div class="mb-3">
                    <input type="text" name="task" placeholder="Tâche" value="<?= $task?? '' ?>" class="form-control" id="">
                    <span class="text-danger"><i><?= $error_task?? '' ?></i></span>
                </div>
                <div class="mb-3">
                    <textarea name="description" id="" cols="30" rows="3" class="form-control" placeholder="La description "><?= $description?? '' ?></textarea>
                    <span class="text-danger"><i><?= $error_description?? '' ?></i></span>
                </div>
            
                <button type="btn btn-primary w-100" type="submit" name="add">Envoyer</button>

            </form>
            </div>
            
        </div>

        <!-- Affichez les tâches existantes ici -->
        <!-- Utilisez PHP pour récupérer les tâches depuis la base de données -->

        <!-- Incluez Bootstrap JS -->
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js
        "></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
    </div>
</body>
</html>
