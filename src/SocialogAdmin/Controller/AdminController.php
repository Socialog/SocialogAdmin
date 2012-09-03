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
        echo 'test';
        $post = new Post;
        $post->setTitle('           sdfasdfsadfm     asdfsafasfsadf     ');
        $post->setContent('asfdasf');
        
        var_dump( $post->isValid() );
        var_dump( $post );
        print_r($post->getInputFilter()->getMessages());
        
        exit;
    }
}
