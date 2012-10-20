<?php

namespace SocialogAdmin\Controller\Plugin;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Auth extends AbstractPlugin
{
    /**
     * @var AdapterInterface
     */
    protected $authAdapter;

    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * @return bool
     */
    public function hasIdentity()
    {
        return $this->getAuthService()->hasIdentity();
    }

    /**
     * @return mixed
     */
    public function getIdentity()
    {
        return $this->getAuthService()->getIdentity();
    }

    /**
     * @return ZfcUserAuthentication
     */
    public function getAuthAdapter()
    {
        if (null === $this->authAdapter) {
            $this->authAdapter = $this->getAuthService()->getAdapter();
        }

        return $this->authAdapter;
    }

    /**
     * @param authAdapter $authAdapter
     */
    public function setAuthAdapter(AuthAdapter $authAdapter)
    {
        $this->authAdapter = $authAdapter;
        return $this;
    }

    /**
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        return $this->authService;
    }

    /**
     * @param AuthenticationService $authService
     */
    public function setAuthService(AuthenticationService $authService)
    {
        $this->authService = $authService;
        return $this;
    }
}