<?php

namespace SocialogAdmin\Controller;

use Socialog\Entity\Page as PageEntity;
use Socialog\Mapper\PageMapper;
use SocialogAdmin\Form\Page as PageForm;
use Zend\View\Model\ViewModel;

/**
 * Pages
 */
class PageController extends AbstractController
{
    /**
     * @var PageMapper
     */
    protected $pageMapper;

    /**
     * @return PageMapper
     */
    public function getPageMapper()
    {
        if (null == $this->pageMapper) {
            $this->pageMapper = $this->getServiceLocator()->get('socialog_page_mapper');
        }

        return $this->pageMapper;
    }

    /**
     * Overview
     */
    public function indexAction()
    {
        $pageMapper = $this->getPageMapper();

        $pages = $pageMapper->findAllPages();
        $messages = $this->flashMessenger()->getMessages();

        return array(
            'pages'		=> $pages,
            'messages'	=> $messages,
        );
    }

    /**
     * Edit Page
     */
    public function editAction()
    {
        $pageId = (int) $this->params('id');

        $page = $this->getPageMapper()->findById($pageId);

        $form = new PageForm();
        $form->bind($page);
        $form->setInputFilter($page->getInputFilter());

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getPageMapper()->save($page);
                $this->flashMessenger()->addMessage('Page succesfully modified!');

                return $this->redirect()->toRoute('socialog-admin/page');
            }
        }

        return array(
            'title' => 'Edit Page',
            'form'	=> $form,
        );
    }

    /**
     * New Page action
     */
    public function newAction()
    {
        $request = $this->getRequest();
        $viewModel = new ViewModel;
        $viewModel->setTemplate('socialog-admin/page/edit');
        $viewModel->title = 'New page';

        $viewModel->form = $form = new PageForm();
        $form->get('submit')->setAttribute('value', 'Create new page');

        if ($request->isPost()) {
            $form->setData($request->getPost());

            $page = new PageEntity();
            $form->bind($page);
            $form->setInputFilter($page->getInputFilter());

            if ($form->isValid()) {
                $this->getPageMapper()->save($page);
                $this->flashMessenger()->addMessage('Page succesfully created!');
                return $this->redirect()->toRoute('socialog-admin/page');
            }
        }

        return $viewModel;
    }
}
