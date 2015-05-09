<?php
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\Query;
class Address extends \Phalcon\Mvc\Model
{
    public $address_id;
	public $user_id;
	public $company;
	public $telephone;
	public $street;
	public $city;
	public $state;
	public $zip;
	public $default_billing;
	public $default_shipping;
	
	public function initialize()
    {
        $this->setSource("users_address");
    }
	
/* 	public function beforeSave()
	{
		$user_id = $this->user_id;
		$default_billing = $this->default_billing;
		$default_shipping = $this->default_shipping;
		if($default_billing){
			try{
				echo "update users_address set default_billing=1 where user_id=$user_id";
				//$query = $this->Query("update users_address set default_billing=1 where user_id=$user_id", $this->getDI());
				$query = $this->Query("update users_address set default_billing=1 where user_id=$user_id");
				//$cars = $this->modelsManager->executeQuery("SELECT * FROM Cars WHERE name = :name:", array(
				//	'name' => 'Audi'
				//));
				$query->execute();
			}
			catch(exception $ex){
				echo $ex->getMessage();
			}
			die;
			
			echo 'updating';
		}
		if($default_shipping){
			//update default_billing address
			$query = $this->Query("update users_address set default_shipping=1 where user_id=$user_id");
			$query->execute();
		}
		die;
	} */
	
	public function afterSave()
	{
		/* $user_id = $this->user_id;
		$result = self::find("user_id=$user_id");
		foreach($result as $row){
			$addressId  = $row->address_id;
			$userAddress = self::findFirstByAddressId($addressId);
			$userAddress->default_billing = 1;
			$userAddress->update();
		} */
	}
	
	public function getCustomerAddressess(){
		$username = $this->session->get("username");
		$user = new Users;
		$user = $user::findFirstByUsername($username);
		$id = $user->id;
		$address = Address::find("user_id =  $id");		
		return $address;
	}
	
	public function getBillingAddress(){
		$username = $this->session->get("username");
		$user = new Users;
		$user = $user::findFirstByUsername($username);
		$id = $user->id;
		$address = Address::findFirst(array('user_id'=>$id,'default_billing' => 1));
		return $address;
	}
	
	public function getShippingAddress(){
		$username = $this->session->get("username");
		$user = new Users;
		$user = $user::findFirstByUsername($username);
		$id = $user->id;
		$address = Address::findFirst(array('user_id'=>$id,'default_billing' => 1));
		return $address;
	}
	
	public function setName($name)
    {
        //The name is too short?
        if (strlen($name) < 10) {
            throw new \InvalidArgumentException('The name is too short');
        }
        $this->name = $name;
    }
	
	/* public function updateUserAddress(){
		$user_id = $this->user_id;
		$user_address = self::find(array(
			"user_id = $user_id"
		));
		foreach ($user_address as $address) {
		   
		}
		die;		
	} */
}