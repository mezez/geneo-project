<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');


    public function index()
    {
        $this->User->Post->recursive = 0;
        $this->Paginator->settings = [
            'contain' => [
                'Post'
            ]
        ];
        $paginated = $this->Paginator->paginate();#
        $this->set('users', $paginated);
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
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
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function login()
    {
        $this->set('login', 1);
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('active') == false) {
                    $this->Session->setFlash(__('Your account is deactivated.'), 'default', array('class' => 'alert alert-danger'));

                    return $this->redirect(['action' => 'logout']);
                }
                $this->set('login', 0);
                //return $this->redirect($this->Auth->redirectUrl());
                return $this->redirect(['controller' => 'posts', 'action' => 'index']);
            }
            $this->Session->setFlash(__('Invalid username or password.'), 'default', array('class' => 'alert alert-danger'));
        }
    }

    public function signup()
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $group = $this->User->Group->find('all', [
                'conditions' => [
                    'name' => 'authors'
                ]
            ]);

            switch ($data['User']['role']) {
                case self::AUTHOR:
                    $group = $this->User->Group->find('all', [
                        'conditions' => [
                            'name' => 'authors'
                        ]
                    ]);

                    $data['User']['group_id'] = $group[0]['Group']['id'];
                    break;
                case self::READER:
                    $group = $this->User->Group->find('all', [
                        'conditions' => [
                            'name' => 'readers'
                        ]
                    ]);
                    $data['User']['group_id'] = $group[0]['Group']['id'];
                    break;
                default:
                    $this->Session->setFlash(__('Sign up unsuccessful. Please try again'), 'default', array('class' => 'alert alert-danger'));
                    return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
            $this->User->create();
            if ($this->User->save($data)) {
                $this->Session->setFlash(__('Sign up successful.'), 'default', array('class' => 'alert alert-success'));
                if ($this->Auth->login()) {
                    $this->set('login', 0);
                    return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
                }
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
            $this->Session->setFlash(__('Sign up unsuccessful, please try again.'), 'default', array('class' => 'alert alert-danger'));
        }
    }

    public function logout()
    {
        $this->set('loggedIn', 0);
        //->Session->setFlash(__('Good bye.'), 'default', array('class' => 'alert alert-success'));
        return $this->redirect($this->Auth->logout());
    }

    //temporary action to implement acl.
    //should be run once and commented out
    public function initDB()
    {
        $group = $this->User->Group;

        // Allow admins to everything
        $group->id = 1;
        $this->Acl->allow($group, 'controllers');

        // allow authors to posts and widgets
        $group->id = 2;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Users/signup');
        $this->Acl->allow($group, 'controllers/Users/login');
        $this->Acl->allow($group, 'controllers/users/logout');
        $this->Acl->allow($group, 'controllers/Posts/index');
        $this->Acl->allow($group, 'controllers/Posts/add');
        $this->Acl->allow($group, 'controllers/Posts/edit');
        $this->Acl->allow($group, 'controllers/Posts/view');
        $this->Acl->allow($group, 'controllers/Posts/delete');

        // allow readers to only add and edit on posts and widgets
        $group->id = 3;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Posts/view');
        $this->Acl->allow($group, 'controllers/Posts/index');
        $this->Acl->allow($group, 'controllers/Users/signup');
        $this->Acl->allow($group, 'controllers/Users/login');
        $this->Acl->allow($group, 'controllers/users/logout');


        // allow basic users to log out
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Users/signup');
        $this->Acl->allow($group, 'controllers/Users/login');
        $this->Acl->allow($group, 'controllers/users/logout');

        // we add an exit to avoid an ugly "missing views" error message
        echo "all done";
        exit;
    }

    //action for promoting/demotng users
    public function promote($id = null, $newRole)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod(['post', 'put']);

        $user = $this->User->find('first', ['conditions' => ['User.id' => $id]]);
        $group = $this->User->Group->find('first', ['conditions' => ['Group.name' => $newRole]]);
        $groupId = $group['Group']['id'];

        if (!empty($user) and !empty($groupId)) {
            if (
                $this->User->saveField('role', substr($newRole, 0, -1)) and $this->User->saveField('group_id', $groupId)
            ) {
                $this->Session->setFlash(__("{$user['User']['username']} is now a(n) {$newRole}"), 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash(__('The update could not be completed. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        return $this->redirect(array('action' => 'index'));
    }

    //action for activating/deactivating users
    public function activate($id = null, $activate)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod(['post', 'put']);

        $user = $this->User->find('first', ['conditions' => ['User.id' => $id]]);

        if (!empty($user)) {
            if ($this->User->updateAll(
                ['User.active' => $activate],
                ['User.id' => $user['User']['id']]
            )
            ) {
                if ($activate == true) {
                    $this->Session->setFlash(__("{$user['User']['username']} is now active"), 'default', array('class' => 'alert alert-success'));
                } else {
                    $this->Session->setFlash(__("{$user['User']['username']} is now inactive"), 'default', array('class' => 'alert alert-success'));

                }
            } else {
                $this->Session->setFlash(__('The update could not be completed. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        return $this->redirect(array('action' => 'index'));
    }


    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(['login', 'signup']);
        $this->Auth->allow('initDB');


        if ($this->Auth->user('role') == self::ADMIN) {
            $this->Auth->allow(['promote', 'activate']);
        }
    }
}
