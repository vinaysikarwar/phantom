<?php
use Phalcon\Db\Column;
use Phalcon\Http\ResponseInterface;

class UserController extends ControllerBase
{
	
	protected function initialize()
    {
		$this->tag->prependTitle('Phantom | ');
		$this->view->setTemplateAfter('main');  
    }
	
	public function setSession($username){
		$session = new Phalcon\Session\Adapter\Files(array(
			'user' =>
				array(
					'username' => $username
				)
		 ));
		return $session;
	} 
	
    public function indexAction()
    {
		if ($this->session->has("username")) {
            return $this->response->redirect('user/account');
        }
		else
		{
			$this->view->pick("user/login");
		}
    }
	
	public function loginAction(){
		
		if ($this->session->has("username")) {
            return $this->response->redirect('user/account');
        }
		if ($this->request->isPost()) {
            if ($this->security->checkToken()) {
                $Data = $this->request->getPost();
				$login = $this->request->getPost('username', 'string');
				$password = $this->request->getPost('password', 'string');
				$user = new Users();
				$user = Users::findFirstByUsername($login);
				if(!$user){
					$user = Users::findFirstByEmail($login);	
				}
				
				if ($user){
					if ($this->security->checkHash($password, $user->password)) {
						$user->active = true;
						try{
							$user->save();						
						}
						catch(exception $ex){}
						$this->flash->success("Welcome $login");
						 $this->session->set("username", $user->username);
						return $this->response->redirect('user/account');
					}
				}

				$this->flash->error('Incorrect email or password!');
				return $this->response->redirect("user/login");
            }
			else{
				$this->flash->error('An Error Occured in login, Please Try again...!');
				return $this->response->redirect('user/login');
			}
        }
		else{
			/* $this->flash->error('An Error Occured in login, Please Try again!');
			return $this->response->redirect('../user'); */
			$this->view->pick("user/login");
		}
	}
	
		
	public function CreateAction(){
		if ($this->session->has("username")) {
            return $this->response->redirect('user/account');
        }
		if ($this->request->isPost()) {
            if ($this->security->checkToken()) {
				$login = $this->request->getPost('username', 'string');
				$email = $this->request->getPost('email', 'string');
				$password = $this->request->getPost('password', 'string');
				$user = Users::findFirstByUsername($login);
				if(!$user){
					$user = Users::findFirstByEmail($email);	
				}
				if(!$user){
					$name = explode(' ', $this->request->getPost('fullname'), 2);
					$firstname = $name[0];
					$lastname = $name[1];
					$password = $this->request->getPost('password');
					$repeatPassword = $this->request->getPost('cpassword');
					if ($password != $repeatPassword) {
						$this->flash->error("Passwords doesn't match!", 'password');
						return;
					}
					$user = new Users();
					$user->firstname = $firstname;
					$user->lastname = $lastname;
					$user->username = strtolower(str_replace(' ', '', $this->request->getPost('username')));
					$user->password = $this->security->hash($this->request->getPost('password'));
					$user->email = $this->request->getPost('email');
					try{
						$user->save();
						$this->flash->success('Registered successfully!');
						$this->session->set('auth', array(
							'id' => $user->id,
							'name' => $user->name
						));
						return $this->response->redirect('user/login');
					}
					catch(exception $ex){
						$this->flash->error('An error occured, unable to register');
						return $this->response->redirect('user/register');
					}
				}
				else{
					$this->flash->error("There is Already an Account with the username $login or email $email.If you forgot your Password, click on Forgot Password Link to reset your password");
					return $this->response->redirect('user/register');
				}
			}
			else
			{
				$this->flash->error('An error occured, unable to register');
				return $this->response->redirect('user/register');
			}
		}
		else
		{
			$this->flash->error('An error occured, unable to register');
			return $this->response->redirect('user/register');
		}
	}
	
	public function registerAction(){
		$this->view->pick('user/register');
	}
	
	public function accountAction()
    {
		$session = $this->session;
        if ($this->session->has("username")) {
			$this->view->pick("user/dashboard");
           $username = $this->session->get("username");
        }
		else{
			return $this->response->redirect('user');
			$this->view->disable;
		}
    }
	
	public function AddressAction(){
		die;
		$session = $this->session;
        if ($this->session->has("username")) {
			$this->view->pick("user/edit/address");
           $username = $this->session->get("username");
        }
		else{
			return $this->response->redirect('user');
			$this->view->disable;
		}
	}
	
	public function newAction(){
		$session = $this->session;
        if ($this->session->has("username")) {
			if ($this->request->isPost()) {
				$address = new Address;
				try{
					$username = $this->session->get("username");
					$user = Users::findFirstByUsername($username);
					if($user){
						$address->user_id=$user->getId();
						//$address->updateUserAddress();
						$address->street = serialize($this->request->getPost('street'));
						unset($_POST['street']);
						$address->save($this->request->getPost());
						$this->flash->success("Your address has been updated");
						return $this->response->redirect('user');
					}
					$this->flash->error("Error! Unable to save Address.");
					return $this->response->redirect('user/address/new');
				}
				catch(exception $ex){
					$this->flash->error("Error! Unable to save Address.");
					return $this->response->redirect('user/address/new');
				}
			}
			else{
				$this->view->pick("user/edit/address");
			}
        }
		else{
			return $this->response->redirect('user');
			$this->view->disable;
		}
	}
	
	public function editAction()
    {
		$session = $this->session;
        if ($this->session->has("username")) {
			$this->view->pick("user/account");
			$username = $this->session->get("username");
			$data = $this->request->getPost();
			if($this->request->isPost()){
				$user = Users::findFirstByUsername($username);
				if($user){
					$firstname = $this->request->getPost('firstname');
					$lastname = $this->request->getPost('lastname');
					$user->firstname = $firstname;
					$user->lastname = $lastname;
					$oldPassword = $user->password;
					if($this->request->getPost('change_password') == "checked"){
						if($this->request->getPost('old_password') != $this->request->getPost('password')){
							if ($this->security->checkHash($this->request->getPost('old_password'), $user->password)) {
								$user->password = $this->security->hash($this->request->getPost('password'));
								$user->old_password = $oldPassword;
							}
							else{
								$this->flash->error("Password Not matched.");
								return $this->response->redirect('user/edit');
								$this->view->disable;
							}
						}
						else{
							$this->flash->error("Old and New Password cannot be same.");
							return $this->response->redirect('user/edit');
							$this->view->disable;
						}
						
					}
					try{
						$user->update();
						$this->flash->success("Your Account is updated");
					}
					catch(exception $ex){
						$this->flash->error("An Error Occured In Updating your Account, Please Try Again Later.");
					}
				}
				return $this->response->redirect('user/account');
				$this->view->disable;			
			}
			else{
				$this->view->pick("user/account/edit");
			}
        }
		else{
			return $this->response->redirect('user');
			$this->view->disable;
		}
		
    }
	
	public function validatepassword(){
		
	}
	
	public function removeAction()
    {
        //Remove a session variable
        $this->session->remove("username");
    }

    public function logoutAction()
    {
        //Destroy the whole session
        $this->session->destroy();
		try{
			$this->flash->success('You are Successfully Logged Out');
		}
		catch(exception $ex){
			$this->flash->error('An error occured in your secure Signout');
		}
		return $this->response->redirect("user/login");
    }
	
	public function resetPasswordAction()
    {
		$code = $this->request->get('code');
		if ($code) {
			$resetPassword = ResetPasswords::findFirstByCode($code);
			if($code == $resetPassword->code){
				if (!$resetPassword) {
					return $this->dispatcher->forward(array(
						'controller' => 'index',
						'action' => 'index'
					));
				}
				if ($resetPassword->reset != 'N') {
					return $this->dispatcher->forward(array(
						'controller' => 'user',
						'action' => 'index'
					));
				}
				else{
					try{
						$resetPassword->save();
						return $this->dispatcher->forward(array(
							'controller' => 'user',
							'action' => 'changePassword'
						));
					}
					catch(exception $ex){
						foreach ($resetPassword->getMessages() as $message) {
							$this->flash->error($message);
						}
						return $this->dispatcher->forward(array(
							'controller' => 'user',
							'action' => 'index'
						));
					}					
				}
			}
			else{
				return $this->dispatcher->forward(array(
					'controller' => 'user',
					'action' => 'index'
				));
			}			
		}
		else{
			$this->view->pick("user/forgotpassword");
		}
	}
	
	public function forgotPasswordAction(){
		
		//Users::send();
		if ($this->request->isPost()) {
			$user = Users::findFirstByUsername($this->request->getPost('username'));
			if(!$user){
				$user = Users::findFirstByEmail($this->request->getPost('username'));	
			}
			if (!$user) {
				$this->flash->error('There is no account associated to this email');
				return $this->response->redirect('user/forgotpassword');
			}
			else{
				$resetPassword = new ResetPasswords();
				$resetPassword->usersId = $user->id;
				if ($resetPassword->save()) {
					$this->flash->success('Success! Please check your messages for an email reset password');
				} else {
					foreach ($resetPassword->getMessages() as $message) {
						$this->flash->error($message);
					}
				}
				return $this->response->redirect('user/index');
			}
		}
		$this->view->pick("user/forgotpassword");
		
	}
	
    /**
     * Users must use this action to change its password
     */
    public function changePasswordAction()
    {
		if ($this->request->isPost()) {
			$email = $this->request->getPost('email');
			if($email){
				$this->session->set("useremail", $email);
			}
			else{
				$email = $this->session->get("useremail");
			}
			
			$user = Users::findFirstByEmail($email);
			if($user){
				$user->old_password = $oldPassword = $user->password;
				if ($this->security->checkHash($this->request->getPost('password'), $oldPassword)) {
					$this->flash->error("Error! Old and New Password can not be same");
					return $this->response->redirect('user/changePassword');
				}
				$user->password = $this->security->hash($this->request->getPost('password'));
				try{
					$user->update();
					$this->flash->success("Success! Password Changed Successfully");
					return $this->response->redirect('user');
				}
				catch(exception $ex){
					$this->flash->error("Error! Please Try Again Later");
					return $this->response->redirect('user/changePassword');
				}
				
			}
			else{
				$this->flash->error("No Account for the particular user Id.");
				return $this->response->redirect('user');
			}
		}
        $this->view->pick("user/changepassword");
    }
}
