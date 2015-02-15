<?php
class UsersController extends AppController{
	public $uses = array('User', 'MovieTag', 'UserFavorite');
	public $layout = 'user';

	function beforeFilter(){
		//親クラスのbeforeFilterの読み込み
		parent::beforeFilter();
		//認証不要のページの指定
		$allow_array = array('login', 'logout','add','opauth_complete','add_user_favorite');
		$this->Auth->allow($allow_array);
	}

	//indexアクション（認証が必要なページ）
	function index(){
		$user = $this->user;
		// ユーザIDから動画をひっぱる
        $movie_list = $this->UserFavorite->get_user_favorite($user['id']);
		$this->set('userfavorite',$movie_list);
		if (!$movie_list) {
			$this->set('osusume',$this->MovieTag->get_by_master_id(OSUSUME_TOP));
		}
		$this->pankuzu[] = array('name' => 'マイページ');
	}

	//ログインアクション（認証が不要なページ）
	function login(){
		//POST送信なら
		if($this->request->is('post')) {
			//ログインOKなら
			if($this->Auth->login()) {
				//戻りURLがある場合はそこに戻る
				if ($this->request->data['User']['controller'] && $this->request->data['User']['action']) {
					return $this->redirect(array('controller' => $this->request->data['User']['controller'], 'action' => $this->request->data['User']['action']));
				} else {
					return $this->redirect($this->Auth->redirect());
				}
			} else { //ログインNGなら
				$this->Session->setFlash(__('ユーザ名かパスワードが違います'), 'default', array(), 'auth');
			}
		}
		$c = "";
		$a = "";
		if (isset($this->request->data['controller']) && isset($this->request->data['action'])) {
			$c = $this->request->data['User']['controller'];
			$a = $this->request->data['User']['action'];
		}
		$this->set('controller', $c);
		$this->set('action', $a);
	}

	//ログアウトアクション（認証が不要なページ）
	function logout(){
		$this->Auth->logout();
		return $this->redirect('/');
	}

	//ユーザー追加（認証が不要なページ）
	function add(){
		//POST送信なら
		if($this->request->is('post')) {
			//ユーザーの作成
			$this->User->create();
			//リクエストデータを保存できたら
			if ($this->User->save($this->request->data)) {
				$this->request->data['User']['id'] = $this->User->id;
				if ($this->request->data['User']['controller'] && $this->request->data['User']['action']) {
					return $this->redirect(array('controller' => $this->request->data['User']['controller'], 'action' => $this->request->data['User']['action']));
				} else {
					return $this->redirect($this->Auth->redirect());
				}
			} else { //保存できなかったら
				$this->Session->setFlash(__('登録できませんでした。やり直して下さい'));
			}
		} else {
			$this->set('prefecture', $this->Prefecture->get_select_list());
			$c = "";
			$a = "";
			if (isset($this->request->data['controller']) && isset($this->request->data['action'])) {
				$c = $this->request->data['User']['controller'];
				$a = $this->request->data['User']['action'];
			}
			$this->set('controller', $c);
			$this->set('action', $a);
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit() {
		$user = $this->Auth->user();
		$id = $user['id'];
		if (!$user) {
			throw new NotFoundException(__('Invalid %s', __('user')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['User']['id'] = $id;
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(
					'更新しました',
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->Auth->login($this->request->data['User']);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('user')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->set('prefecture', $this->MasterTag->get_list_by_id(PREFECTURE));
			$this->request->data = $this->User->read(null, $id);
		}
		$this->pankuzu[] = array('name' => 'マイページ', 'url' => array('controller' => 'users', 'action' => 'index'));
		$this->pankuzu[] = array('name' => 'ユーザ情報編集');
	}
	
	public function opauth_complete() {
		//echo '<pre>';
		//print_r($this->data);
		//echo '</pre>';
		//exit();
		// まず会員登録チェック
		if (!isset($this->data['auth'])) {
			$this->Session->setFlash(
				'facebookで何かエラーが起きてるみたいです。しばらく待ってログインしてください',
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				)
			);
			$this->redirect('/');
		}
		$facebook_id = $this->data['auth']['uid'];
		
		if ($facebook_id) {
//			// ログイン済なら、facebook_idを登録してあげる
//			if ($this->Auth->login()) {
//				$user_data = $this->Auth->user();
//				if (!isset($user_data['User']['facebook_id'])) {
//					// 既にfacebook_idのデータがあったら統合する
//					$userMainAccount = $this->User->find( 'first',array ('conditions' => array('User.facebook_id' => $facebook_id)));
//					if (isset($userMainAccount['User']) && is_array($userMainAccount) ) {
//						$userMainAccount['User']['facebook_id'] = "delete_".$userMainAccount['User']['facebook_id'];
//						$this->User->save($userMainAccount);
//					}
//					$user_data['User']['facebook_id'] = $facebook_id;
//					$this->User->save($user_data);
//				}
//				if ($this-> Auth->login($user_data['User'])) {
//					return $this->redirect($this->Auth->redirect());
//				}
//			}
			$prefecture_id = 0;
			$userMainAccount = $this->User->find( 'first',array ('conditions' => array('User.facebook_id' => $facebook_id)));
			if (isset($userMainAccount['User']) && is_array($userMainAccount) ) {
				if ($this->Auth->login($userMainAccount['User'])) {
					return $this->redirect($this->Auth->redirect());
				}
			} else {
				if (isset($this->data['auth']['raw']['hometown']) && isset($this->data['auth']['raw']['hometown']['name'])) {
					$hometown = split(',', $this->data['auth']['raw']['hometown']['name']);
					$prefecture_id = 0;
					foreach ($hometown as $h) {
						$h = trim(strtolower($h));
						$prefecture = $this->MasterTag->findPrefectire($h);
						if ($prefecture) {
							$prefecture_id = $prefecture['MasterTag']['id'];
						}
					}
				}
				
				$user_data = array();
				$save_ok = true;
				$user_data['User']['facebook_id'] = $facebook_id;
				if (isset($this->data['auth']['info']['nickname'])) {
					$user_data['User']['nickname'] = $this->data['auth']['info']['nickname'];
				} else if (isset($this->data['auth']['info']['name'])) {
					$user_data['User']['nickname'] =  $this->data['auth']['info']['name'];
				} else {
					$save_ok = false;
				}
				
				if (isset($this->data['auth']['info']['email'])) {
					$user_data['User']['email'] = $this->data['auth']['info']['email'];
				} else {
					$save_ok = false;
				}
				
				if (isset($this->data['auth']['raw']['bio'])) {
					$user_data['User']['profile_fields'] = $this->data['auth']['raw']['bio'];
				}

				if ($prefecture_id != 0) {
					$user_data['User']['prefecture_id'] = $prefecture_id;
				} else {
					$zenkoku = $this->MasterTag->get_zenkoku();
					$user_data['User']['prefecture_id'] = $zenkoku['MasterTag']['id'];
				}
				if ($save_ok) {
					$this->User->create();
					if ($this->User->save($user_data)) {
						$user_data['User']['id'] = $this->User->id;
						$this->Session->setFlash(
							'新規ユーザーを追加しました！',
							'alert',
							array(
								'plugin' => 'TwitterBootstrap',
								'class' => 'alert-success'
							)
						);
						if ($this-> Auth->login($user_data['User'])) {
							return $this->redirect($this->Auth->redirect());
						}
					} else { //保存できなかったら
						$this->Session->setFlash(__('登録できませんでした。やり直して下さい'));
					}
					//リクエストデータを保存できたら
					$this->redirect(array('action' => 'index'));
					return;
				}
				$this->request->data = $user_data;
//				$this->set('user', $user_data);
				$this->set('prefecture', $this->MasterTag->get_user_prefecture());
				$this->render();
			}
		} else {
			$this->redirect(array('controller' => 'auth', 'action' => 'facebook'));
		}
		
	}
	

}