<?php

namespace SocialogAdmin\Controller;

use Socialog\Entity\Post;

class AdminController extends AbstractController
{
    public function indexAction()
    {
        $this->testAction();
        $test = "
Hello
This is a test
Test 2
        ";
 
        return array(
            'test' => $test,
        );
    }
    public function testAction()
    {
        $post = new Post;
        $post->setTitle('           sdfasdfsadfm     asdfsafasfsadf     ');
        $post->setContent('asfdasf');
        
        //$db = $this->getServiceLocator()->get('doctrine.connection.orm_default');

    }
}
