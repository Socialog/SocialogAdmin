<?php

namespace SocialogAdmin\Controller;

use Socialog\Entity\Post as PostEntity;
use Socialog\Mapper\PostMapper;
use SocialogAdmin\Form\Post as PostForm;
use Zend\View\Model\ViewModel;

/**
 * Posts
 */
class PostController extends AbstractController
{
    /**
     * @var PostMapper
     */
    protected $postMapper;

    /**
     * @return PostMapper
     */
    public function getPostMapper()
    {
        if (null == $this->postMapper) {
            $this->postMapper = $this->getServiceLocator()->get('socialog_post_mapper');
        }

        return $this->postMapper;
    }

    /**
     * Overview
     */
    public function indexAction()
    {
        $postMapper = $this->getPostMapper();

        $posts = $postMapper->selectWith($postMapper->select()->order('id DESC'));
        $messages = $this->flashMessenger()->getMessages();

        return array(
			'posts'		=> $posts,
			'messages'	=> $messages,
		);
    }

    /**
     * Edit Post
     */
    public function editAction()
    {
        $postId = (int) $this->params('id');

        $post = $this->getPostMapper()->findById($postId);

        $form = new PostForm();
        $form->bind($post);
        $form->setInputFilter($post->getInputFilter());

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getPostMapper()->save($post);
                $this->flashMessenger()->addMessage('Post succesfully modified!');

                return $this->redirect()->toRoute('socialog-admin/post');
            }
        }

        return array(
			'title' => 'Edit Post',
			'form'	=> $form,
		);
    }

    /**
     * New Post action
     */
    public function newAction()
    {
        $request = $this->getRequest();
		$viewModel = new ViewModel;
		$viewModel->setTemplate('socialog-admin/page/edit');
		$viewModel->title = 'New post';

		$viewModel->form = $form = new PostForm();
		$form->get('submit')->setAttribute('value', 'Create new post');

        if ($request->isPost()) {
            $form->setData($request->getPost());

            $post = new PostEntity();
            $form->bind($post);
            $form->setInputFilter($post->getInputFilter());

            if ($form->isValid()) {
                $this->getPostMapper()->save($post);
                $this->flashMessenger()->addMessage('Post succesfully created!');
                return $this->redirect()->toRoute('socialog-admin/post');
            }
        }

        return $viewModel;
    }
}
