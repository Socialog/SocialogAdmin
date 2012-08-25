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
			}
        }, 100);
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
}
