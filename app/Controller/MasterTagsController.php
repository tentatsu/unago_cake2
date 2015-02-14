<?php
App::uses('AppController', 'Controller');
/**
 * MasterTags Controller
 *
 * @property MasterTag $MasterTag
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MasterTagsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
		$this->Auth->allow();
		$this->set('master_tags', get_master_tag_names());
	}

	/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MasterTag->recursive = 0;
		$this->set('masterTags', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MasterTag->exists($id)) {
			throw new NotFoundException(__('Invalid master tag'));
		}
		$options = array('conditions' => array('MasterTag.' . $this->MasterTag->primaryKey => $id));
		$this->set('masterTag', $this->MasterTag->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MasterTag->create();
			if ($this->MasterTag->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The master tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The master tag could not be saved. Please, try again.'));
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
	public function edit($id = null) {
		if (!$this->MasterTag->exists($id)) {
			throw new NotFoundException(__('Invalid master tag'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MasterTag->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The master tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The master tag could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MasterTag.' . $this->MasterTag->primaryKey => $id));
			$this->request->data = $this->MasterTag->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MasterTag->id = $id;
		if (!$this->MasterTag->exists()) {
			throw new NotFoundException(__('Invalid master tag'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MasterTag->delete()) {
			$this->Session->setFlash(__('The master tag has been deleted.'));
		} else {
			$this->Session->setFlash(__('The master tag could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->MasterTag->recursive = 0;
		$this->set('masterTags', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->MasterTag->exists($id)) {
			throw new NotFoundException(__('Invalid master tag'));
		}
		$options = array('conditions' => array('MasterTag.' . $this->MasterTag->primaryKey => $id));
		$this->set('masterTag', $this->MasterTag->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->MasterTag->create();
			if ($this->MasterTag->save($this->request->data)) {
				$this->Session->setFlash(__('The master tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The master tag could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->MasterTag->exists($id)) {
			throw new NotFoundException(__('Invalid master tag'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MasterTag->save($this->request->data)) {
				$this->Session->setFlash(__('The master tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The master tag could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MasterTag.' . $this->MasterTag->primaryKey => $id));
			$this->request->data = $this->MasterTag->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->MasterTag->id = $id;
		if (!$this->MasterTag->exists()) {
			throw new NotFoundException(__('Invalid master tag'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MasterTag->delete()) {
			$this->Session->setFlash(__('The master tag has been deleted.'));
		} else {
			$this->Session->setFlash(__('The master tag could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
