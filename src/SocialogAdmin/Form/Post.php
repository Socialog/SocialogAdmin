<?php

namespace SocialogAdmin\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

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

        $this->setHydrator(new ClassMethods(false));
    }

}
