<?php
App::uses('AppController', 'Controller');

/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function isAuthorized($user)
    {
        // Only Authors and Admin users can add posts
        if ($this->action === 'add') {
            if ((isset($user['role']) && $user['role'] === 'author') || (isset($user['role']) && $user['role'] === 'admin')) {
                return true;
            } else {
                return false;
            }
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int)$this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $userId = $this->Auth->user('id');
        $role = $this->Auth->user('role');

        $this->Post->recursive = 0;
//		$this->Paginator->settings = [
//			'contain' => [
//				'Users'
//			]
//		];
        $paginated = $this->Paginator->paginate();
//		debug($paginated);die();
        $this->set('posts', $paginated);
        $this->set('userId', $userId);
        $this->set('role', $role);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }
        $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
        $this->set('post', $this->Post->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('The post has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The post could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $userId = $this->Auth->user('id');
        $userRole = $this->Auth->user('role');

        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('The post has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The post could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            if ($userRole != self::ADMIN) {
                $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id, 'user_id' => $userId));
            } else {

                $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
            }
            $this->request->data = $this->Post->find('first', $options);
            if(empty($this->request->data)){
                $this->Session->setFlash('You can only edit you own posts' , 'default', array('class' => 'alert alert-danger'));
                return $this->redirect(['action' => 'index']);
            }

        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->Post->id = $id;
        $userId = $this->Auth->user('id');

        if (!$this->Post->exists()) {
            throw new NotFoundException(__('Invalid post'));
        }
        $post = $this->Post->find('first',['conditions' => ['Post.id' => $id]]);
        if($post['Post']['user_id'] != $userId){
            $this->Session->setFlash(__('You can only delete your own posts.'), 'default', array('class' => 'alert alert-danger'));
            return $this->redirect('index');
        }

        $this->request->onlyAllow('post', 'delete');
        if ($this->Post->delete()) {
            $this->Session->setFlash(__('The post has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The post could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
