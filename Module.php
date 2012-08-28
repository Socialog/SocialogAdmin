<?php

namespace SocialogAdmin;

/**
 * Socialog Admin Module
 */
class Module
{
    /**
     * Bootstrap event
     *
     * @param type $e
     */
    public function onBootstrap($e)
    {
        $app = $e->getApplication();

        $sharedEvents = $app->getEventManager()->getSharedManager();
        $sharedEvents->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
            $controller = $e->getTarget();
            if ($controller instanceof Controller\AbstractController) {
                $controller->layout('socialog-admin/layout');

                $sm = $controller->getServiceLocator();
                $auth = $sm->get('socialog_auth');

                if (!$auth->hasIdentity() && !$controller instanceof Controller\UserController) {
                    return $controller->redirect()->toRoute('socialog-admin/user');
                }
            }
        }, 9999);
    }

    /**
     * Module Configuration
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Autoloader Configuration
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Service Configuration
     */
    public function getServiceConfig()
    {
        return include __DIR__ . '/config/service.config.php';
    }

    /**
     * Controller Helper Configuration
     */
    public function getControllerPluginConfig()
    {
        return array(
            'factories' => array(
                'socialogauth' => function($sm) {
                    $sm = $sm->getServiceLocator();
                    $helper = new Controller\Plugin\Auth;
                    $helper->setAuthService($sm->get('socialog_auth'));
                    return $helper;
                }
            )
        );
    }
}
