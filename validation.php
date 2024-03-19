<?php
session_start();

require "connexion.php";
$erreur = $data= [];

//Delete
if(isset($_POST['delete'])){
    //
    if(empty($_POST['delete'])){
        $erreur +=['delete'=>'erreur id'];
    } 
    else{
        $id = $_POST['delete'];
    }
    //erreur est vide ou pas
    if(empty($erreur)){
        //insertion de données
        try{
            $sql = "DELETE from todos where id = :id";
            $requete = $dbb->prepare($sql);
            $requete->bindParam(":id",$id,PDO::PARAM_INT);
            $requete->execute();
            $_SESSION['message']="Cet Task a été supprimé avec succes";
            header("location: index.php");
        } catch(PDOException$e){
            $requete_erreur = $e->getMessage();
            echo $requete_erreur;
        }

    } 
    else{
        $_SESSION['erreur']=$erreur;
        $_SESSION['data']=$data;
        header("location: index.php");

    }
}
//Modifier les données
if(isset($_POST['update'])){
    //id
    if(empty($_POST['id']))
    {
        $erreur+=['id'=>'erreur id'];
    }
    else{
        $id = $_POST['id'];
    }
    // task
    if(empty($_POST['task']))
    {
        $erreur += ['task'=> 'Ce champ Tâche est requis'];
    }
    else {
        $task = $_POST['task'];
        $data += ['task'=> $task];
    }
    // description
    if(empty($_POST['description']))
    {
        $erreur += ['description'=> 'Ce champ Description est requis'];
    }
    else {
        $description = $_POST['description'];
        $data += ['description'=> $description];
    }
    if(empty($erreur))
    {
        // insertion
        try{
            $sql = "UPDATE todos set task = :task, description = :description where id = :id";
            $query = $dbb->prepare($sql);
            $query->bindParam(":task", $task, PDO::PARAM_STR);
            $query->bindParam(":description", $description, PDO::PARAM_STR);
            $query->bindParam(":id", $id, PDO::PARAM_INT);

            $query->execute();
            $_SESSION['message']= "Task Modifier avec succès";
            header("location: index.php");
        }catch(PDOException $e)
        {
            $query_erreur = $e->getMessage();
           echo $query_erreur;
        }
         
    }
    else{
        $_SESSION['erreur']= $erreur;
        $_SESSION['data']= $data;
        header("location: edit.php");
    }
   
}
// ajouter
if(isset($_POST['add']))
{
    //Task
    if(empty($_POST['task']))
    {
        $erreur+=['task'=> 'Ce champ Tâche est requis'];
    }else {
        $task = $_POST['task'];
        $data += ['task'=> $task];
    }
    // description
    if(empty($_POST['description']))
    {
        $erreur += ['description'=> 'Ce champ Description est requis'];
    }
    else {
        $description = $_POST['description'];
        $data += ['description'=> $description];
    }
   
    // erreur est vide ou pas
    if(empty($erreur))
    {
        // insertion
        try{
            $sql = "INSERT into todos (task, description) 
            values (:task, :description)";
            $query = $dbb->prepare($sql);
            $query->bindParam(":task", $task, PDO::PARAM_STR);
            $query->bindParam(":description", $description, PDO::PARAM_STR);

            $query->execute();
            $_SESSION['message']= "Task ajouter avec succès";
            header("location: index.php");
        }catch(PDOException $e)
        {
            $query_erreur = $e->getMessage();
           echo $query_erreur;
        }
         
    }
    else{
        $_SESSION['erreur']= $erreur;
        $_SESSION['data']= $data;
        header("location: create.php");
    }

}

