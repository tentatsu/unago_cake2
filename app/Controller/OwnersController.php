<?php
App::uses('AppController', 'Controller');
App::uses('OwnerRegistrationService', 'Service');
App::uses('CakeEmail', 'Network/Email');

/**
 * Owners Controller
 *
 * @property Owner $Owner
 * @property OwnerRegistration $OwnerRegistration
 * @property Pet $Pet
 */
class OwnersController extends AppController {

    public $uses = [
        'Owner',
        'OwnerRegistration',
        'Pet',
    ];

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

	/**
     * 新規登録メールの送信
     */
    public function signupEmail() {
        $this->set('title_for_layout', '新規会員登録');
        if ($this->request->is(['post', 'put'])) {
            $this->OwnerRegistration->begin();
            try {
                $data = $this->request->data;
                $this->OwnerRegistration->set($data);
                if (!$this->OwnerRegistration->validates()) {
                    throw new Exception();
                }

                $conditions = [
                    'OwnerRegistration.email' => $data['OwnerRegistration']['email'],
                ];
                $contain = [];
                $ownerRegistration = $this->OwnerRegistration->find('first', compact('conditions', 'contain'));
                if (!empty($ownerRegistration)) {
                    $data['OwnerRegistration']['id'] = $ownerRegistration['OwnerRegistration']['id'];
                }

                $this->OwnerRegistration->create();
                if (!$this->OwnerRegistration->save($data, true)) {
                    throw new Exception();
                }

                $id = $this->OwnerRegistration->id;
                $conditions = [
                    'OwnerRegistration.id' => $id,
                ];
                $contain = [];
                $ownerRegistration = $this->OwnerRegistration->find('first', compact('conditions', 'contain'));
                /** @var CakeEmail $Email */
                $Email = new CakeEmail('default');
                $OwnerRegistrationService = new OwnerRegistrationService($Email);
                $OwnerRegistrationService->sendConfirmEmail($ownerRegistration);

                $this->OwnerRegistration->commit();
                $this->set(compact('ownerRegistration'));
                $this->render('/Owners/signup_email_complete');
            } catch (Exception $e) {
                CakeLog::alert($e->getMessage());
                $this->OwnerRegistration->rollback();
                $this->Session->setFlash('新規登録メールが送信できませんでした', 'alert');
            }
        }
    }

    /**
     * メール確認
     *
     * @param $id
     * @param $token
     */
    public function signupEmailConfirm($id, $token) {

        $OwnerRegistrationService = new OwnerRegistrationService(null, $this->OwnerRegistration);
        $ownerRegistration = $OwnerRegistrationService->confirmEmail($id, $token);
        if (!$ownerRegistration) {
            throw new NotFoundException();
        }

        $this->OwnerRegistration->delete($ownerRegistration['OwnerRegistration']['id']);
        $this->Session->write('registration_email', $ownerRegistration['OwnerRegistration']['email']);
        $this->redirect(['action' => 'signup']);
    }

    /**
     * サインアップ
     */
    public function signup() {
        $this->set('title_for_layout', '新規会員登録');
        if ($this->request->is(['post', 'put'])) {
            if (!$this->Session->check('signup_data')) {
                $this->redirect(['controller' => 'home', 'action' => 'index']);
            }
            if (empty($this->request->data['Owner']['p'])) {
                $this->redirect(['controller' => 'home', 'action' => 'index']);
            }

            $p = $this->request->data['Owner']['p'];
            switch ($p) {
//                case Configure::read('Owner.signup_process.pet'):
//                    // ペット入力
//                    $this->__petInput();
//                    break;
//                case Configure::read('Owner.signup_process.questionnaire'):
//                    // アンケート入力
//                    $this->__questionnaireInput();
//                    break;
                default:
                    $this->redirect(['controller' => 'home', 'action' => 'index']);
            }
        } else {
            if (!$this->Session->check('registration_email')) {
                throw new NotFoundException();
            }
            $email = $this->Session->read('registration_email');
            $this->Session->delete('registration_email');
            $this->Session->delete('signup_data');

            $owner = [
                'Owner' => [
                    'email' => $email
                ]
            ];
            $this->Session->write('signup_data', $owner);
        }
        $order = ['Company.id' => 'ASC'];
        $companies = $this->Owner->Company->find('list', compact('order'));

        $this->set(compact('companies'));
    }

    /**
     * ペット情報入力
     */
    private function __petInput() {
        $data = $this->request->data;
        $fieldList = [
            'Owner' => [
                'last_name',
                'first_name',
                'last_name_kana',
                'first_name_kana',
                'company_id',
                'section',
                'password',
                'prefecture',
                'is_open',
            ],
        ];
        if (!$this->Owner->validateAssociated($data, compact('fieldList'))) {
            $this->Session->setFlash('入力内容が正しくありません。ご確認ください', 'alert');
            return;
        }
        $owner = $this->Session->read('signup_data');
        $data['Owner']['email'] = $owner['Owner']['email'];
        $this->Session->write('signup_data', $data);

        /** @var PetClassification $PetClassification */
        $PetClassification = ClassRegistry::init('PetClassification');
        $order = ['PetClassification.id' => 'ASC'];
        $petClassifications = $PetClassification->find('list', compact('order'));

        $this->set(compact('petClassifications'));
        $this->set('title_for_layout', 'ペット情報登録');
        $this->render('/Owners/signup2');
    }

    /**
     *
     */
    private function __questionnaireInput() {
        $data = $this->request->data;
        unset($data['Owner']);

        if (!$this->Pet->validateMany($data['Pet'])) {
            $this->Session->setFlash('入力内容が正しくありません。ご確認ください', 'alert');
            /** @var PetClassification $PetClassification */
            $PetClassification = ClassRegistry::init('PetClassification');
            $order = ['PetClassification.id' => 'ASC'];
            $petClassifications = $PetClassification->find('list', compact('order'));

            $this->set(compact('petClassifications'));
            $this->set('title_for_layout', 'ペット情報登録');
            $this->render('/Owners/signup2');
            return;
        }

        $owner = $this->Session->read('signup_data');
        $owner['Pet'] = $data['Pet'];
        $this->Session->write('signup_data', $data);

        /** @var OwnerRegistrationService $OwnerRegistrationService */
        $OwnerRegistrationService = new OwnerRegistrationService(new CakeEmail('bcc'), $this->OwnerRegistration, $this->Owner);
        if (!$OwnerRegistrationService->saveOwner($owner)) {
            $this->Session->setFlash('新規登録できませんでした。再度登録をお願いいたします', 'alert');
            $this->redirect(['controller' => 'home', 'action' => 'index']);
        }

        $this->set('title_for_layout', '新規会員登録');
        $this->render('/Owners/signup_complete');
    }

	public function login() {
		$this->set('title_for_layout', 'ログイン');
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$user = array();
				$user['Owner'] = $this->Auth->user();
				$user['Owner']['login_failure_number'] = 0;
				$this->Owner->save($user, array(
					'validate' => false,
					'fieldList' => array(
						'login_failure_number'
					),
					'callbacks' => false
				));

				$this->Session->setFlash(__('ログインしました。'), 'default', array('class' => 'success-message'),'success');
				$this->redirect(['controller' => 'home', 'action' => 'index']);
			} else {
				$d = $this->data;
				$this->Owner->recursive = -1;
				$o = $this->Owner->findByEmail($d['Owner']['email']);
				if ($o && $o['Owner']['owner_status'] == OWNER_STATUS_VALID) {
					$o['Owner']['login_failure_number']++;
					if ($o['Owner']['login_failure_number'] >= LOGIN_FAILER_MAX_COUNT) {
						$o['Owner']['login_failure_number'] = 0;
						$o['Owner']['owner_status'] = OWNER_STATUS_LOCK;
						$o['Owner']['lock_date'] = date('Y-m-d H:i:s');
					}
					$this->Owner->save($o, array(
						'validate' => false,
						'fieldList' => array(
							'login_failure_number', 'owner_status', 'lock_date'
						),
						'callbacks' => false
					));
				}
				//$this->Session->setFlash(__('ログイン／パスワードが違います。再度ご確認下さい。'), 'default', array(), 'auth');
				$this->Session->setFlash(__('ログイン／パスワードが違います。再度ご確認下さい。'), 'default', array(), 'auth_error');
			}
		}

	}
	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	/**
	 * パスワード再設定メールの送信
	 */
	public function password() {
		$this->set('title_for_layout', 'パスワード再設定');
		if ($this->request->is(['post', 'put'])) {
			$this->Owner->begin();
			try {
				$data = $this->request->data;
				$this->Owner->recursive = -1;
				$owner = $this->Owner->findByEmail($data['Owner']['email']);
				if ($owner) {
					$passwordReminderDate = strftime('%F %T');
					$token = Security::hash($this->data['Owner']['email'] . $passwordReminderDate, 'sha256', true);
					$owner['Owner']['password_reminder_token'] = $token;
					$owner['Owner']['password_reminder_date'] = $passwordReminderDate;

					$this->Owner->save($owner, array(
						'validate' => false,
						'fieldList' => array(
							'password_reminder_token', 'password_reminder_date'
						),
						'callbacks' => false
					));

					/** @var CakeEmail $Email */
					$Email = new CakeEmail('default');
					$OwnerRegistrationService = new OwnerRegistrationService($Email);
					$OwnerRegistrationService->sendChangeEmail($owner);

					$this->Owner->commit();
					$this->set(compact('owner'));
					$this->render('/Owners/password_email_complete');
				} else {
					$this->set('error', 'no_data');
				}
			} catch (Exception $e) {
				CakeLog::alert($e->getMessage());
				$this->OwnerRegistration->rollback();
				$this->Session->setFlash('新規登録メールが送信できませんでした', 'alert');
			}
		}
	}

	/**
	 * パスワード変更メール確認
	 *
	 * @param $id
	 * @param $token
	 */
	public function passwordChangeConfirm($id = null, $token = null) {

		$session_id = $this->Session->read('password_change_id');
		$conditions = [];
		if ($session_id) {
			$conditions = [
				'Owner.id' => $session_id,
			];
		} else {
			$conditions = [
				'Owner.id' => $id,
				'Owner.password_reminder_token' => $token,
			];
		}
		$contain = [];
		$owner = $this->Owner->find('first', compact('conditions', 'contain'));
		if (empty($owner['Owner'])) {
			CakeLog::alert("新規登録情報が見つかりませんでした。id = " . $id);
			$this->redirect(['action' => 'password']);
		}

		$passwordDate = strtotime($owner['Owner']['password_reminder_date']);
		$now = time();
		if (($now - $passwordDate) > (60 * 60 * 24)) {
			$this->redirect(['action' => 'password']);
		}

		$this->Session->write('password_change_id', $owner['Owner']['id']);
		return $passwordDate;
	}

	/**
	 * パスワード変更完了
	 *
	 * @param $id
	 * @param $token
	 */
	public function passwordChangeComplete() {
		$id = $this->Session->read('password_change_id');

		$owner = $this->Owner->findById($id);
		if (empty($owner['Owner'])) {
			CakeLog::alert("新規登録情報が見つかりませんでした。id = " . $id);
			return false;
		}
		$data = $this->data;
		$this->Owner->validate = array('password' => $this->Owner->validate['password']);
		$data['Owner']['password_reminder_token'] = "";
		$data['Owner']['password_reminder_date'] = "";
		$this->Owner->id = $id;
		if ($this->Owner->save($data)) {
			$this->Session->delete('password_change_id');
		} else {
			$this->redirect(['action' => 'passwordChangeConfirm']);
		}
	}
}
