<?php
session_start();
require "connexion.php";
$sql = "SELECT * From todos order by created_at desc";
//Preparation de la requete
$requete = $dbb->prepare($sql);
$requete->execute();
$tasks = $requete->fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taches</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Ajout de styles CSS personnalisés */
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6; /* Ajoute des bordures */
        }

        .table-bordered thead th {
            background-color: #f8f9fa; /* Couleur de fond pour les en-têtes de colonne */
        }

        .table-bordered tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa; /* Couleur de fond pour les lignes impaires du tableau */
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="col-md-8 mx-auto">
            <div class="card shadow p-5">
                <h3>Liste des Tâches à faire
                    <a href="create.php" class="btn btn-outline-primary btn-sm float-end">Ajouter</a>
                </h3>

                <div class="card-body">
                    <table class="table table-bordered"> <!-- Ajoute la classe 'table-bordered' pour les bordures -->
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Taches</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($tasks) > 0) : ?>
                                <?php $numero = 0; ?>
                                <?php foreach ($tasks as $task) : ?>
                                    <?php $numero++; ?>
                                    <tr>
                                        <td><?= $numero ?></td>
                                        <td><?= $task['task'] ?></td>
                                        <td><?= $task['description'] ?></td>
                                        <td class="d-flex align-items-center">
                                            <a href="view.php?id=<?= $task['id'] ?>" class="me-2 text-info" title="Détails"><i class="bi bi-eye"></i></a>
                                            <a href="modifier.php?id=<?= $task['id'] ?>" class="me-2 text-primary" title="Modifier"><i class="bi bi-pencil-square"></i></a>
                                            <form action="validation.php" method="post">
                                                <button class="text-danger fw-bolder border-0" onclick="return confirm('Voulez vous supprimer cet élément ?')" name="delete" value="<?= $task['id'] ?>" title="Supprimer"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
