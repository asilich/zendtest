<?php
// Filename: /module/Blog/src/Blog/Controller/WriteController.php
namespace Blog\Controller;

use Blog\Service\PostServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WriteController extends AbstractActionController
{
    /**
     * @var PostServiceInterface
     */
    protected $postService;

    /**
     * @var FormInterface
     */
    protected $postForm;

    /**
     * @param PostServiceInterface $postService
     * @param FormInterface $postForm
     */
    public function __construct(
        PostServiceInterface $postService,
        FormInterface $postForm
    ) {
        $this->postService = $postService;
        $this->postForm    = $postForm;
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function addAction()
    {
        $request = $this->getRequest();

        if($request->isPost()) {
            $this->postForm->setData($request->getPost());

            if($this->postForm->isValid()) {
                try {
                    $this->postService->savePost($this->postForm->getData());

                    return $this->redirect()->toRoute('blog');
                } catch (\Exception $e) {

                }
            }
        }
        return new ViewModel(array(
            'form' => $this->postForm
        ));
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function editAction()
    {
        $request = $this->getRequest();
        $post = $this->postService->findPost($this->params('id'));

        $this->postForm->bind($post);

        if ($request->isPost()) {
            $this->postForm->setData($request->getPost());

            if ($this->postForm->isValid()) {
                try {
                    $this->postService->savePost($this->postForm->getData());

                    return $this->redirect()->toRoute('blog');
                } catch (\Exception $e) {

                }
            }
        }
        return new ViewModel(array(
            'form' => $this->postForm
        ));
    }
}
 