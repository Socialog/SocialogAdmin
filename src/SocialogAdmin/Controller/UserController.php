<?php

namespace SocialogAdmin\Controller;

use Zend\Authentication\AuthenticationService;

/**
 * Controls authentication and user actions
 */
class UserController extends AbstractController
{
	/**
	 * @var AuthenticationService
	 */
	protected $authService;
	
	
	/**
	 * Admin home
	 * 
	 * Redirect if there is no valid user
	 */
	public function indexAction()
	{
		if (!$this->socialogauth()->hasIdentity()) {
			return $this->redirect()->toRoute('socialog-admin/user', array(
				'action' => 'login'
			));
		}

		return array();
	}
		
	/**
	 * Login form
	 */
    public function loginAction()
    {
		$this->layout('socialog-admin/user/layout');

		$request = $this->getRequest();
		$auth = $this->getAuthService();

		$adapter = $auth->getAdapter();
		$adapter->bindRequest($request);

		if ($request->isPost()) {
			$authResult = $auth->authenticate($adapter);
			
			if ($authResult->isValid()) {
				return $this->redirect()->toRoute('socialog-admin');
			}
		}

        return array();
    }
	
	/**
	 * Logout the current user
	 */
	public function logoutAction()
	{
		$auth = $this->getAuthService();
		$user = $auth->getIdentity();
		
		$auth->clearIdentity();

		return $this->redirect()->toRoute('socialog-admin/user');
	}

	/**
	 * @return AuthenticationService
	 */
	public function getAuthService()
	{
		if (null == $this->authService) {
			$this->authService = $this->getServiceLocator()->get('socialog_auth');
		}
		return $this->authService;
	}

	/**
	 * @param AuthenticationService $authService
	 */
	public function setAuthService(AuthenticationService $authService)
	{
		$this->authService = $authService;
	}
}