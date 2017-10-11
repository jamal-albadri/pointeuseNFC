<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function connectDb(){
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=pointeuse;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    
    return $bdd;
}

function getUsers(){
    $connexion= connectDb();
    $request=$connexion->prepare("SELECT * FROM `collaborateurs`");
    $request->execute();
    $resulat=$request->fetchAll(PDO::FETCH_ASSOC);
    return $resulat;
}

function getUser($idUser){
    $bdd = connectDb();
    $requete = $bdd->prepare("SELECT idUser,FirstName,LastName,Pseudo FROM collaborateurs WHERE idUser = :idUser");
    $requete->execute(array('idUser'=>$idUser));
    $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $donnees;
}

function deleteUser($idUser){
    $bdd = connectDb();
    $reponse = $bdd->query("DELETE FROM collaborateurs WHERE idUser = $idUser");
    return $reponse;
}

function addUser($nom, $prenom, $email, $pwd,$heure){
    $bdd = connectDb();
    $req = $bdd->prepare("INSERT INTO collaborateurs (nom,prenom,email,motDePasse,heureDebut)"
            . " VALUES(:nom, :prenom, :email, :motDePasse, :heure)");
    $req->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'motDePasse' => $pwd,
        'heure' => $heure
        ));
    return $req;
    /*$bdd->query("SELECT IdUser FROM myevents.users WHERE (FirstName = $prenom"
            . " AND LastName = $nom AND Pseudo = $pseudo AND Password = $pwd)");*/
}

function updateUser($prenom, $nom, $pseudo, $pwd, $idUser){
    $bdd = connectDb();
    $req = $bdd->prepare("UPDATE collaborateurs SET FirstName = :FirstName,"
            . "LastName = :LastName,Pseudo = :Pseudo,users.Password = :Password WHERE idUser=:IdUser;");
    $req->execute(array(
        'FirstName' => $prenom,
        'LastName' => $nom,
        'Pseudo' => $pseudo,
        'Password' => $pwd,
        'IdUser' => $idUser
        ));
    return $req;
}

function getUsersNames(){
    $bdd = connectDb();
    $req = $bdd->prepare("SELECT idUser, CONCAT(LastName,' ', FirstName) AS Name FROM collaborateurs;");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_KEY_PAIR);
}