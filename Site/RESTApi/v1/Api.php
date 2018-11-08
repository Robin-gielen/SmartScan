<?php 
 
 //getting the dboperation class
 require_once '../includes/DbOperation.php';
 
 //function validating all the paramters are available
 //we will pass the required parameters to this function 
 function isTheseParametersAvailable($params){
 //assuming all parameters are available 
 $available = true; 
 $missingparams = ""; 
 
 foreach($params as $param){
 if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
 $available = false; 
 $missingparams = $missingparams . ", " . $param; 
 }
 }
 
 //if parameters are missing 
 if(!$available){
 $response = array(); 
 $response['error'] = true; 
 $response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
 
 //displaying error
 echo json_encode($response);
 
 //stopping further execution
 die();
 }
 }
 
 //an array to display response
 $response = array();
 
 //if it is an api call 
 //that means a get parameter named api call is set in the URL 
 //and with this parameter we are concluding that it is an api call
 if(isset($_GET['apicall'])){
 
 switch($_GET['apicall']){
 
 //the CREATE operation
 //if the api call value is 'createuser'
 //we will create a record in the database
 case 'createuser':
 //first check the parameters required for this request are available or not 
 isTheseParametersAvailable(array('nom','prenom','adresse','mail', 'localite', 'pseudo', 'password'));
 
 //creating a new dboperation object
 $db = new DbOperation();
 
 //creating a new record in the database
 $result = $db->createUser(
 $_POST['nom'], 
 $_POST['prenom'], 
 $_POST['adresse'],
 $_POST['mail'],
 $_POST['localite'],
 $_POST['pseudo'],
 $_POST['password']
 );
 
 
 //if the record is created adding success to response
 if($result){
 //record is created means there is no error
 $response['error'] = false; 
 
 //in message we have a success message
 $response['message'] = 'User addedd successfully';
 
 //and we are getting all the users from the database in the response
 $response['users'] = $db->getUsers();
 }else{
 
 //if record is not added that means there is an error 
 $response['error'] = true; 
 
 //and we have the error message
 $response['message'] = 'Some error occurred please try again';
 }
 
 break; 
 
 //the READ operation
 //if the call is getusers
 case 'getusers':
 $db = new DbOperation();
 $response['error'] = false; 
 $response['message'] = 'Request successfully completed';
 $response['users'] = $db->getUsers();
 break; 
 
 
 //the UPDATE operation
 case 'updateuser':
 isTheseParametersAvailable(array('id','nom','prenom','adresse','mail', 'localite', 'pseudo', 'password'));
 $db = new DbOperation();
 $result = $db->updateUser(
 $_POST['id'],
 $_POST['nom'], 
 $_POST['prenom'], 
 $_POST['adresse'],
 $_POST['mail'],
 $_POST['localite'],
 $_POST['pseudo'],
 $_POST['password']
 );
 
 if($result){
 $response['error'] = false; 
 $response['message'] = 'User updated successfully';
 $response['users'] = $db->getUsers();
 }else{
 $response['error'] = true; 
 $response['message'] = 'Some error occurred please try again';
 }
 break; 
 
 //the delete operation
 case 'deleteuser':
 
 //for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
 if(isset($_GET['id'])){
 $db = new DbOperation();
 if($db->deleteUser($_GET['id'])){
 $response['error'] = false; 
 $response['message'] = 'User deleted successfully';
 $response['users'] = $db->getUsers();
 }else{
 $response['error'] = true; 
 $response['message'] = 'Some error occurred please try again';
 }
 }else{
 $response['error'] = true; 
 $response['message'] = 'Nothing to delete, provide an id please';
 }
 break; 
 }
 
 }else{
 //if it is not api call 
 //pushing appropriate values to response array 
 $response['error'] = true; 
 $response['message'] = 'Invalid API Call';
 }
 
 //displaying the response in json structure 
 echo json_encode($response);