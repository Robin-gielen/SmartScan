<?php 

require_once ('./vendor/autoload.php');

class RestApiTest extends PHPUnit\Framework\TestCase
{
	private $http;

	public function setUp()
	{
		$this->http = new GuzzleHttp\Client(['base_uri' => 'http://www.smartscan-bc.ovh/RESTApi/v1/Api.php']);
	}

	public function tearDown()
	{
		$this->http = null;
	}


	public function testGetUsers()
	{
		$response = $this->http->request('GET', '?apicall=getusers');
		
		$this->assertEquals(200, $response->getStatusCode());
	}

	public function testCreateUser()
	{	
		$response = $this->http->request('POST', '?apicall=createuser', [
			'json' => [
				'nom'    => 'apiTest',
				'prenom'     => 'apiTest',
				'adresse'    => 'apiTest',
				'mail'    => 'apiTest',
				'localite'    => 'apiTest',
				'pseudo'    => 'apiTest',
				'password'    => 'apiTest'
			]
		]);

		$this->assertEquals(200, $response->getStatusCode());

		$data = json_decode($response->getBody(), true);

		//$this->assertEquals('apiTest' + $userId, $data['nom']);
	}
	
	public function testCreateUserMissingArgument()
	{
		$response = $this->http->request('POST', '?apicall=createuser', [
			'json' => [
				'nom'    => 'apiTest',
				'prenom'     => 'apiTest',
				'adresse'    => 'apiTest',
				'mail'    => 'apiTest',
				'localite'    => 'apiTest',
				'pseudo'    => 'apiTest'
			]
		]);
		
		$extractedResponse = (string) $response->getBody();

		$json = json_decode($extractedResponse); 
		$status = $json->status;

		$this->assertEquals(422, $status);
	}
	
	public function testUpdateUser()
	{
		$userId = uniqid();
		
		$response = $this->http->request('POST', '?apicall=updateuser', [
			'json' => [
				'id' 	=> '1',
				'nom'    => 'apiTest' + $userId,
				'prenom'     => 'apiTest' + $userId,
				'adresse'    => 'apiTest' + $userId,
				'mail'    => 'apiTest' + $userId,
				'localite'    => 'apiTest' + $userId,
				'pseudo'    => 'apiTest' + $userId,
				'password'    => 'apiTest' + $userId
			]
		]);
		
		$this->assertEquals(200, $response->getStatusCode());
	}
	
	public function testUpdateUserMissingArgument()
	{
		$response = $this->http->request('POST', '?apicall=updateuser', [
			'json' => [
				'id' 	=> '1',
				'nom'    => 'apiTest',
				'prenom'     => 'apiTest',
				'adresse'    => 'apiTest',
				'mail'    => 'apiTest',
				'localite'    => 'apiTest',
				'pseudo'    => 'apiTest'
			]
		]);
		$extractedResponse = (string) $response->getBody();

		$json = json_decode($extractedResponse); 
		$status = $json->status;

		$this->assertEquals(422, $status);
	}
	
	/*
	public function testDeleteUser()
	{
		$response = $this->http->request('POST', '?apicall=deleteuser', [
			'json' => [
				'id' 	=> '1'
			]
		]);
		
		$this->assertEquals(200, $response->getStatusCode());
	}
	*/
	
	
	public function testGetContacts()
	{
		$response = $this->http->request('GET', '?apicall=getcontacts');
		
		$this->assertEquals(200, $response->getStatusCode());
	}

	public function testCreateContact()
	{
		$contactId = uniqid();
		
		
		$response = $this->http->request('POST', '?apicall=createcontact', [
			'json' => [
				'nom'     => 'apiTest' + $contactId,
				'prenom'     => 'apiTest',
				'mail'     => 'apiTest',
				'phone'     => 'apiTest',
				'adresse'     => 'apiTest',			
				'localite'     => 'apiTest',
				'nomSociete'     => 'apiTest',
				'activite'     => 'apiTest',
				'idUtilisateur'     => 'apiTest',
				'siteWeb'     => 'apiTest',
				'cat'     => 'apiTest'
			]
		]);

		$this->assertEquals(200, $response->getStatusCode());

		$data = json_decode($response->getBody(), true);

		//$this->assertEquals('apiTest' + $contactId, $data['nom']);
	}
	
	public function testCreateContactMissingArgument()
	{
		$response = $this->http->request('POST', '?apicall=createcontact', [
			'json' => [
				'nom'     => 'apiTest',
				'prenom'     => 'apiTest',
				'mail'     => 'apiTest',
				'phone'     => 'apiTest',
				'adresse'     => 'apiTest',			
				'localite'     => 'apiTest',
				'nomSociete'     => 'apiTest',
				'activite'     => 'apiTest',
				'idUtilisateur'     => 'apiTest',
				'siteWeb'     => 'apiTest'
			]
		]);
		
		$extractedResponse = (string) $response->getBody();

		$json = json_decode($extractedResponse); 
		$status = $json->status;

		$this->assertEquals(422, $status);
	}
	
	public function testUpdateContact()
	{
		$contactId = uniqid();
		
		$response = $this->http->request('POST', '?apicall=updatecontact', [
			'json' => [
				'id'	=> '1',
				'nom'     => 'apiTest' + $contactId,
				'prenom'     => 'apiTest' + $contactId,
				'mail'     => 'apiTest' + $contactId,
				'phone'     => 'apiTest' + $contactId,
				'adresse'     => 'apiTest' + $contactId,
				'localite'     => 'apiTest' + $contactId,
				'nomSociete'     => 'apiTest' + $contactId,
				'activite'     => 'apiTest' + $contactId,
				'idUtilisateur'     => 'apiTest' + $contactId,
				'siteWeb'     => 'apiTest' + $contactId,
				'cat'     => 'apiTest' + $contactId
			]
		]);
		
		$this->assertEquals(200, $response->getStatusCode());
	}
	public function testUpdateContactMissingArgument()
	{
		$contactId = uniqid();
		
		$response = $this->http->request('POST', '?apicall=updatecontact', [
			'json' => [
				'id'	=> '1',
				'nom'     => 'apiTest',
				'prenom'     => 'apiTest',
				'mail'     => 'apiTest',
				'phone'     => 'apiTest',
				'adresse'     => 'apiTest',
				'localite'     => 'apiTest',
				'nomSociete'     => 'apiTest',
				'activite'     => 'apiTest',
				'idUtilisateur'     => 'apiTest',
				'siteWeb'     => 'apiTest'
			]
		]);
		
		$extractedResponse = (string) $response->getBody();

		$json = json_decode($extractedResponse); 
		$status = $json->status;

		$this->assertEquals(422, $status);
	}
	
	/*
	public function testDeleteContact()
	{
		$response = $this->http->request('POST', '?apicall=deletecontact', [
			'json' => [
				'id' 	=> '1'
			]
		]);
		
		$this->assertEquals(200, $response->getStatusCode());
	}
	*/
}
