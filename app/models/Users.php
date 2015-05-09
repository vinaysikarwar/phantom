<?php
use Phalcon\Db\Column;
class Users extends \Phalcon\Mvc\Model
{
	public $id;
	public $username;
	public $name;
	public $email;
    
	
	public function initialize()
    {
        $this->setSource("users");
    }
	
	public function getId()
    {
        return $this->id;
    }
	
	public function setName($name)
    {
        //The name is too short?
        if (strlen($name) < 10) {
            throw new \InvalidArgumentException('The name is too short');
        }
        $this->name = $name;
    }
	
	public function getName()
    {
        return $this->name;
    }
	
	public function validateLogin(){
		$user = User::findFirst(
            [
                "email = ?0 OR username = ?0",
                "bind" => [$login],
                "bindTypes" => [Column::BIND_PARAM_STR]
            ]
        );
	}
	
	public function send($to, $subject, $name, $params)
    {
        
    }
}