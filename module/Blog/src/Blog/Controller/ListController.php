<?php
namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Service\PostServiceInterface;
use Zend\View\Model\ViewModel;
use Zend\View\View;

class ListController extends AbstractActionController
{
    /**
     * @var \Blog\Service\PostServiceInterface;
     */
    protected $postService;

    public function __construct(PostServiceInterface $postServiceInterface)
    {
        $this->postService = $postServiceInterface;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'posts' => $this->postService->findAllPosts()
        ));
    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');

        try {
            $post = $this->postService->findPost($id);
        } catch(\InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('blog');
        }
        return new ViewModel(array(
                'post' => $post
        ));
    }
}