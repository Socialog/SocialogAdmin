<?php

namespace SocialogAdmin;

use Zend\Authentication\AuthenticationService;

return array(
    'invokables' => array(
        'SocialogAdmin\Authentication\Storage\Db' => 'SocialogAdmin\Authentication\Storage\Db',
    ),
    'factories' => array(
        'socialog-admin-navigation' => 'SocialogAdmin\Service\NavigationFactory',
        'socialog_auth' => function($sm) {
            return new AuthenticationService(
                $sm->get('SocialogAdmin\Authentication\Storage\Db'),
                $sm->get('SocialogAdmin\Authentication\Adapter\Db')
            );
        },
        'socialog_admin_passwordencrypter' => function($sm) {
            $bcrypt = new \Zend\Crypt\Password\Bcrypt;
            $bcrypt->setSalt('jeswa3uG4kE5aYerEChap4eKu7'); // TODO
            return $bcrypt;
        },
        'SocialogAdmin\Authentication\Adapter\Db' => function($sm) {
            $adapter = new Authentication\Adapter\Db;
            $adapter->setServiceManager($sm);

            $encryptor = $sm->get('socialog_admin_passwordencrypter');
            $adapter->setPasswordEncryptor(function($password) use ($encryptor){
                return $encryptor->create($password);
            });

            return $adapter;
        }
    ),
);