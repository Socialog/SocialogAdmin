<?php

namespace SocialogAdmin\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Stdlib\Hydrator\ClassMethods;
use Socialog\Entity\Post as PostEntity;

class Post extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('post');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            )
        ));
        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));
        $this->add(array(
            'name' => 'content',
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'span9',
                'rows' => 20,
            ),
            'options' => array(
                'label' => 'Content',
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Save changes',
                'id' => 'submitbtn',
                'class' => 'btn btn-primary',
            ),
        ));

        $status = new Element\Select('status');
        $status->setValueOptions(array(
           PostEntity::STATUS_PUBLISHED => 'Publish',
           PostEntity::STATUS_DRAFT     => 'Draft',
        ));
        
        $this->add($status);

        $this->setHydrator(new ClassMethods(false));
    }

}
