<?php
App::uses('AppModel', 'Model');
/**
 * Tag Model
 *
 */
class Tag extends AppModel {
	public $belongsTo = array('Movie', 'MasterTag' => array('counterCache' => true));

    public function get_by_master_id($id) {
		$movie = null;
		$movie = $this->_get_cache('get_by_master_id_'. $id);
		if (!$movie) {
			$this->recursive = 1;
			$movie = $this->find('all', array(
				'conditions' => array(
					'MasterTag.master_id' => $id,
				),
				'order' => 'Tag.created desc'
			));
			Cache::write('get_by_master_id_'. $id, $movie);
		}
		return $movie;
    }
	public function get_by_master_tag_id($id) {
		$movie = null;
		$movie = $this->_get_cache('get_by_master_tag_id_'. $id);
		if (!$movie) {
			$this->recursive = 1;
			$movie = $this->find('all', array(
				'conditions' => array(
					'Tag.master_tag_id' => $id,
				),
                'order' => array('Movie.id desc')
			));
			Cache::write('get_by_master_tag_id_'. $id, $movie);
		}
		return $movie;
	}
}
