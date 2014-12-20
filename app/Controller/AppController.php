<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $viewClass = 'App';
    public $components = array(
        'Session',
        'DebugKit.Toolbar',
        'Security' => ['validatePost' => false],
		'Auth' => array(
			'loginRedirect'  => array('controller' => 'owners', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'owners', 'action' => 'login'),
			'loginAction'    => array('controller' => 'owners', 'action' => 'login'),
			'authenticate'   => array(
				'Form' => array(
					'userModel' => 'Owner',
					'fields' => array('username' => 'email'),
					'scope' => array('owner_status' => OWNER_STATUS_VALID),
					'passwordHasher' => array(
						'className' => 'Simple',
						'hashType' => 'sha256'
					)
				)
			)
		)
    );
    public $helpers = [
        'Session',
        'Time',
        'Form' => ['className' => 'AppForm'],
    ];
    public $sslFlag = true;

    /**
     * コンストラクタ
     *
     * @param null $request
     * @param null $response
     */
    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);
    }

    /**
     * 事前処理
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
		$this->layout = "bootstrap3";

//        $this->Security->blackHoleCallback = '_blackHole';
//        if ($this->sslFlag) {
//            $this->Security->requireSecure();
//        }
    }

//    /**
//     * @param $param
//     */
//    protected function _blackHole($param) {
//        switch ($param) {
//            case 'secure':
//                $this->redirect('https://' . env('SERVER_NAME') . $this->here);
//                break;
//            case 'csrf':
//                CakeLog::warning("CSRFの可能性があるアクセスがありました。remote_addr = " . $_SERVER['REMOTE_ADDR']);
//                $this->redirect('/');
//                break;
//        }
//    }
}
