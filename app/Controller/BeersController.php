<?php
App::uses('AppController', 'Controller');
/**
 * Beers Controller
 *
 * @property Beer $Beer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BeersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
		parent::beforeFilter();
//		$this->Auth->allow();
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Beer->recursive = 0;
		$this->set('beers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Beer->exists($id)) {
			throw new NotFoundException(__('Invalid beer'));
		}
		$options = array('conditions' => array('Beer.' . $this->Beer->primaryKey => $id));
		$this->set('beer', $this->Beer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Beer->create();
			if ($this->Beer->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The beer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The beer could not be saved. Please, try again.'));
			}
		}
		$companies = $this->Beer->Company->find('list');
		$this->set(compact('companies'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Beer->exists($id)) {
			throw new NotFoundException(__('Invalid beer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Beer->save($this->request->data)) {
				$this->Session->setFlash(__('The beer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The beer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Beer.' . $this->Beer->primaryKey => $id));
			$this->request->data = $this->Beer->find('first', $options);
		}
		$companies = $this->Beer->Company->find('list');
		$this->set(compact('companies'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Beer->id = $id;
		if (!$this->Beer->exists()) {
			throw new NotFoundException(__('Invalid beer'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Beer->delete()) {
			$this->Session->setFlash(__('The beer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The beer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
