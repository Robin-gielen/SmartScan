<?php

 /*
 * Created by Robin Gielen
 */
 
class DbOperation
{
    //Database connection link
    private $con;
 
    //Class constructor
    function __construct()
    {
        //Getting the DbConnect.php file
        require_once dirname(__FILE__) . '/DbConnect.php';
 
        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();
 
        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->con = $db->connect();
    }
 
 /*
 * The create operation
 * When this method is called a new record is created in the database
 */
 function createUser($nom, $prenom, $adresse, $mail, $localite, $pseudo, $password){
 $stmt = $this->con->prepare("INSERT INTO Utilisateurs (Nom, Prenom, Adresse, Mail, Localite, Pseudo, Password) VALUES (?, ?, ?, ?, ?, ?, ?)");
 $stmt->bind_param("sssssss", $nom, $prenom, $adresse, $mail, $localite, $pseudo, $password);
 if($stmt->execute())
 return true; 
 return false; 
 }
 
 /*
 * The read operation
 * When this method is called it is returning all the existing record of the database
 */
 function getUsers(){
 $stmt = $this->con->prepare("SELECT id_Utilisateur, Nom, Prenom, Adresse, Mail, Localite, Pseudo, Password FROM Utilisateurs");
 $stmt->execute();
 $stmt->bind_result($id, $nom, $prenom, $adresse, $mail, $localite, $pseudo, $password);
 
 $users = array(); 
 
 while($stmt->fetch()){
 $user  = array();
 $user['id_Utilisateur'] = $id; 
 $user['Nom'] = $nom; 
 $user['Prenom'] = $prenom; 
 $user['Adresse'] = $adresse; 
 $user['Mail'] = $mail; 
 $user['Localite'] = $localite;
 $user['Pseudo'] = $pseudo;
 $user['Password'] = $password;
 
 array_push($users, $user); 
 }
 
 return $users; 
 }
 
 /*
 * The update operation
 * When this method is called the record with the given id is updated with the new given values
 */
 function updateUser($id, $nom, $prenom, $adresse, $mail, $localite, $pseudo, $password){
 $stmt = $this->con->prepare("UPDATE Utilisateurs SET Nom = ?, Prenom = ?, Adresse = ?, Mail = ?, Localite = ?, Pseudo = ?, Password = ? WHERE id_Utilisateur = ?");
 $stmt->bind_param("sssssssi", $nom, $prenom, $adresse, $mail, $localite, $pseudo, $password, $id);
 if($stmt->execute())
 return true; 
 return false; 
 }
 
 
 /*
 * The delete operation
 * When this method is called record is deleted for the given id 
 */
 function deleteUser($id){
 $stmt = $this->con->prepare("DELETE FROM Utilisateurs WHERE id_Utilisateur = ? ");
 $stmt->bind_param("i", $id);
 if($stmt->execute())
 return true; 
 
 return false; 
 }
}
