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
 
 
 // Users related operations 
 
 
 /*
 * The create user operation
 * When this method is called a new record is created in the user table
 */
 function createUser($nom, $prenom, $adresse, $mail, $localite, $pseudo, $password){
 $stmt = $this->con->prepare("INSERT INTO Utilisateurs (Nom, Prenom, Adresse, Mail, Localite, Pseudo, Password) VALUES (?, ?, ?, ?, ?, ?, ?)");
 $stmt->bind_param("sssssss", $nom, $prenom, $adresse, $mail, $localite, $pseudo, $password);
 if($stmt->execute())
 return true; 
 return false; 
 }
 
 /*
 * The read users operation
 * When this method is called it is returning all the existing record of the user table
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
 * The read user operation
 * When this method is called it is returning the existing record of a user with the specified username
 */
 function getUser($pseudo){
 $stmt = $this->con->prepare("SELECT Nom, Prenom, Adresse, Mail, Localite, Pseudo, Password FROM Utilisateurs WHERE Pseudo = 'Gimkil'");
 //$stmt->bind_param("s", $pseudo);
 $stmt->execute();
 $stmt->bind_result($nom, $prenom, $adresse, $mail, $localite, $pseudo, $password);
 
 $user  = array();
 $user['Nom'] = $nom; 
 $user['Prenom'] = $prenom; 
 $user['Adresse'] = $adresse; 
 $user['Mail'] = $mail; 
 $user['Localite'] = $localite;
 $user['Pseudo'] = $pseudo;
 $user['Password'] = $password;
 
 return $user; 
 }
 
 /*
 * The update user operation
 * When this method is called the record with the given id is updated with the new given values in the user table
 */
 function updateUser($id, $nom, $prenom, $adresse, $mail, $localite, $pseudo, $password){
 $stmt = $this->con->prepare("UPDATE Utilisateurs SET Nom = ?, Prenom = ?, Adresse = ?, Mail = ?, Localite = ?, Pseudo = ?, Password = ? WHERE id_Utilisateur = ?");
 $stmt->bind_param("sssssssi", $nom, $prenom, $adresse, $mail, $localite, $pseudo, $password, $id);
 if($stmt->execute())
 return true; 
 return false; 
 }
 
 
 /*
 * The delete user operation
 * When this method is called record is deleted for the given id in the user table
 */
 function deleteUser($id){
 $stmt = $this->con->prepare("DELETE FROM Utilisateurs WHERE id_Utilisateur = ? ");
 $stmt->bind_param("i", $id);
 if($stmt->execute())
 return true; 
 
 return false; 
 }
 
 
 //Contacts related operations
 
 
 /*
 * The create Contact operation
 * When this method is called a new record is created in the Contact table
 */
 function createContact($nom, $prenom, $mail, $phone, $adresse, $localite, $nomSociete, $activite, $idUtilisateur, $siteWeb, $cat){
 $stmt = $this->con->prepare("INSERT INTO Contacts (Nom, Prenom, Mail, Telephone, Adresse, Localite, NomSociete, Activite, id_Utilisateur, SiteWeb, Cat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
 $stmt->bind_param("ssssssssiss", $nom, $prenom, $mail, $phone, $adresse, $localite, $nomSociete, $activite, $idUtilisateur, $siteWeb, $cat);
 if($stmt->execute())
 return true; 
 return false; 
 }
 
 /*
 * The read Contact operation
 * When this method is called it is returning all the existing record of the Contact table
 */
 function getContacts(){
 $stmt = $this->con->prepare("SELECT id_Utilisateur, Nom, Prenom, Mail, Telephone, Adresse, Localite, NomSociete, Activite, id_Utilisateur, SiteWeb, Cat FROM Contacts");
 $stmt->execute();
 $stmt->bind_result($id, $nom, $prenom, $mail, $phone, $adresse, $localite, $nomSociete, $activite, $idUtilisateur, $siteWeb, $cat);
 
 $users = array(); 
 
 while($stmt->fetch()){
 $user  = array();
 $user['id_Contact'] = $id; 
 $user['Nom'] = $nom; 
 $user['Prenom'] = $prenom; 
 $user['Mail'] = $mail; 
 $user['Telephone'] = $phone; 
 $user['Adresse'] = $adresse;
 $user['Localite'] = $localite;
 $user['NomSociete'] = $nomSociete;
 $user['Activite'] = $activite; 
 $user['id_Utilisateur'] = $idUtilisateur;
 $user['SiteWeb'] = $siteWeb;
 $user['Cat'] = $cat;
 
 array_push($users, $user); 
 }
 
 return $users; 
 }
 
 /*
 * The read Contact operation
 * When this method is called it is returning all the existing record of the Contact table
 */
 function getMyContacts($idUtilisateur){
 $stmt = $this->con->prepare("SELECT id_Contact, Nom, Prenom, Mail, Telephone, Adresse, Localite, NomSociete, Activite, id_Utilisateur, SiteWeb, Cat FROM Contacts where id_Utilisateur = ?");
 $stmt->bind_param("s", $idUtilisateur);
 $stmt->execute();
 $stmt->bind_result($id, $nom, $prenom, $mail, $phone, $adresse, $localite, $nomSociete, $activite, $idUtilisateurRet, $siteWeb, $cat);
 
 $users = array(); 
 
 while($stmt->fetch()){
 $user  = array();
 $user['id_Contact'] = $id; 
 $user['Nom'] = $nom; 
 $user['Prenom'] = $prenom; 
 $user['Mail'] = $mail; 
 $user['Telephone'] = $phone; 
 $user['Adresse'] = $adresse;
 $user['Localite'] = $localite;
 $user['NomSociete'] = $nomSociete;
 $user['Activite'] = $activite; 
 $user['id_Utilisateur'] = $idUtilisateurRet;
 $user['SiteWeb'] = $siteWeb;
 $user['Cat'] = $cat;
 
 array_push($users, $user); 
 }
 
 return $users; 
 }
 
 /*
 * The update Contact operation
 * When this method is called the record with the given id is updated with the new given values in the Contact table
 */
 function updateContact($nom, $prenom, $mail, $phone, $adresse, $localite, $nomSociete, $activite, $idUtilisateur, $siteWeb, $cat){
 $stmt = $this->con->prepare("UPDATE Contacts SET Nom =?, Prenom =?, Mail =?, Telephone =?, Adresse =?, Localite =?, NomSociete =?, Activite =?, id_Utilisateur =?, SiteWeb =?, Cat =? WHERE id_Contact = ?");
 $stmt->bind_param("ssssssssissi", $nom, $prenom, $mail, $phone, $adresse, $localite, $nomSociete, $activite, $idUtilisateur, $siteWeb, $cat, $id);
 if($stmt->execute())
 return true; 
 return false; 
 }
 
 
 /*
 * The delete Contact operation
 * When this method is called record is deleted for the given id in the Contact table
 */
 function deleteContact($id){
 $stmt = $this->con->prepare("DELETE FROM Contacts WHERE id_Contact = ? ");
 $stmt->bind_param("i", $id);
 if($stmt->execute())
 return true; 
 
 return false; 
 }
 
 
 
}
