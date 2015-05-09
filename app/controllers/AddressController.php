<?php
use Phalcon\Db\Column;
use Phalcon\Http\ResponseInterface;
class AddressController extends ControllerBase
{
	
	protected function initialize()
    {
        $this->tag->prependTitle('PhalconCMS | ');
        $this->view->setTemplateAfter('main');
    }
	
    public function indexAction()
    {
		$session = $this->session;
		$id = $this->dispatcher->getParam("id");
        if ($this->session->has("username")) {
			if ($this->request->isPost()) {
				try{
					
					$Address = Address::findFirst("address_id=$id");
					if($Address){
						$Address->street = serialize($this->request->getPost('street'));
						unset($_POST['street']);
						$Address->update($this->request->getPost());
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
				$this->view->pick("user/address");
			}
        }
		else{
			return $this->response->redirect('user');
			$this->view->disable;
		}
    }
	
	
	public function editAction(){
		$session = $this->session;
		$id = $this->dispatcher->getParam("id");
        if ($this->session->has("username")) {
			if ($this->request->isPost()) {
				try{
					
					$Address = Address::findFirst("address_id=$id");
					if($Address){
						$Address->street = serialize($this->request->getPost('street'));
						unset($_POST['street']);
						$Address->update($this->request->getPost());
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
}
