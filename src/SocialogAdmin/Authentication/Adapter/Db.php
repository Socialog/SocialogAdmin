<?php

namespace SocialogAdmin\Authentication\Adapter;

use Socialog\Mapper\UserMapper;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\PasswordInterface;
use Zend\Http\PhpEnvironment\Request;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

class Db implements ServiceManagerAwareInterface, AdapterInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var UserMapper
     */
    protected $userMapper;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Callable
     */
    protected $passwordEncryptor;

    /**
     * @param Request $request
     */
    public function bindRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Result
     */
    public function authenticate()
    {
        $request = $this->request;
        $post = $request->getPost()->toArray();

        $password	= $post['password'];
        $email		= $post['email'];

        $user = $this->getUserMapper()->findByEmail($email);

        // Check if we have a valid user
        if (!$user) {
            return new Result(Result::FAILURE_IDENTITY_NOT_FOUND, null, array(
                'Username not found'
            ));
        }

        // Check if the password is valid
        $password = $this->preprocessPassword($password);

        if ($user->getPassword() !== $password) {
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array(
                'Invalid password'
            ));
        }

        return new Result(Result::SUCCESS, $user);
    }

    /**
     * Encrypt the password if there is a password encryptor available
     *
     * @param string $password
     * @return string
     */
    public function preprocessPassword($password)
    {
        $encryptor = $this->getPasswordEncryptor();

        if ($encryptor instanceof PasswordInterface) {
            $password = $encryptor->create($password);
        } elseif (is_callable($encryptor)) {
            $password = $encryptor($password);
        }

        return $password;
    }

    /**
     * @return UserMapper
     */
    public function getUserMapper()
    {
        if (null == $this->userMapper) {
            $this->userMapper = $this->getServiceManager()->get('socialog_user_mapper');
        }
        return $this->userMapper;
    }

    /**
     * @param UserMapper $userMapper
     */
    public function setUserMapper(UserMapper $userMapper)
    {
        $this->userMapper = $userMapper;
    }

    /**
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @param ServiceManager $serviceManager
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @return Callable
     */
    public function getPasswordEncryptor()
    {
        return $this->passwordEncryptor;
    }

    /**
     * @param PasswordInterface|Callable $passwordEncryptor
     */
    public function setPasswordEncryptor($passwordEncryptor)
    {
        $this->passwordEncryptor = $passwordEncryptor;
    }
}