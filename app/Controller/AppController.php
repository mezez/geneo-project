<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    const AUTHOR = 'author';
    const ADMIN = 'admin';
    const READER = 'reader';

    public $components = array(
        'Acl',
        'Session',
        'Flash',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            ),
            'loginRedirect' => array(
                'controller' => 'posts',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            )
        )
    );

    public $helpers = array('Html', 'Form', 'Session');

    public function beforeFilter()
    {
        //Configure AuthComponent
        $this->Auth->loginAction = array(
            'controller' => 'users',
            'action' => 'login'
        );
//        $this->Auth->authorize = 'actions';
//        $this->Auth->actionPath = 'controllers/';
        //$this->Auth->allow('index', 'view');
        //$this->Auth->allow();
        $userId = $this->Auth->user('id');
        $role = $this->Auth->user('role');

        if($role == self::ADMIN){
            $this->set('isAdmin', 1);
        }
        if (isset($userId)) {
            $this->set('loggedIn', 1);

        }else{
            $this->set('loggedIn', 0);
        }
        $this->set('login', 0);//used to know when on log in page
        $this->layout = 'bootstrap';

    }

    public function isAuthorized($user)
    {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Default deny
        return false;
    }
}
