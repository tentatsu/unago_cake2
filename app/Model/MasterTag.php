<?php
App::uses('AppModel', 'Model');
/**
 * MasterTag Model
 *
 */
class MasterTag extends AppModel {
	public $hasMany = array(
		'MovieTag' => array(
			'className' => 'Tag',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Image' => array(
			'className' => 'Attachment',
			'foreignKey' => 'foreign_key',
			'conditions' => array(
				'Image.model' => 'MasterTag',
			),
		),
	);

	public function get_list($master_id, $page, $limit, $order='created') {
		$target = $this->_get_cache('master_tag_get_list_'.$master_id."_".$page."_".$limit."_".$order);
		if (!$target) {
			$this->recursive = 2;
			$this->MovieTag->unbindModel(array(
				'belongsTo' => array('MasterTag')
			));
			$target = $this->find('all', array(
				'conditions' => array(
					'MasterTag.movie_tag_count >' => 0,
					'MasterTag.master_id' => $master_id,
				),
				'limit' => $limit+1,
				'offset' => $limit * ($page-1),
				'order' => 'MasterTag.'.$order.' desc',
			));
			Cache::write('master_tag_get_list_'.$master_id."_".$page."_".$limit."_".$order, $target);
		}
		return $target;
	}

	function get_all() {
		$target = $this->_get_cache('master_tag_detail_all');
		if (!$target) {
			$this->recursive = -1;
			$target = $this->find('all', array(
				'order' => 'id'));
			Cache::write('master_tag_detail_all', $target);
		}
		return $target;

	}
	function get_by_id($id) {
		$target = $this->_get_cache('master_tag_detail_by_id'. $id);
		if (!$target) {
			$this->recursive = -1;
			$target = $this->findById($id);
			Cache::write('master_tag_detail_by_id'. $id, $target);
		}
		return $target;
	}
    function get_all_by_id($id, $include_zero = true, $order = 'ASC ') {
        $target = $this->_get_cache('master_tag_detail_all_by_id'. $id."_".$include_zero. "_". $order);
        if (!$target) {
            $this->recursive = -1;
			$condition = array('master_id' => $id);
			if (!$include_zero) {
				$condition['movie_tag_count >'] = 0;
			}
            $target = $this->find('all', array(
                'conditions' => $condition,
                'order' => 'id '.$order));
            Cache::write('master_tag_detail_all_by_id'. $id."_".$include_zero. "_". $order, $target);
        }
        return $target;
    }
	function get_list_by_id($id, $order = 'ASC ', $order_target = 'id') {
		$target = $this->_get_cache('master_tag_detail_list_by_id'. $id. '_'.$order);
		if (!$target) {
			$this->recursive = -1;
			$target = $this->find('list', array(
				'fields' => array('id', 'name'),
				'conditions' => array('master_id' => $id),
				'order' => $order_target. ' '.$order));
			Cache::write('master_tag_detail_list_by_id'. $id. '_'.$order, $target);
		}
		return $target;
	}
	function get_user_prefecture() {
		return $this->find('list', array(
			'conditions' => array('master_id' => BOSS, 'other_name is not null'),
		));
	}
	function get_zenkoku() {
		return $this->find('first', array(
			'conditions' => array('master_id' => BOSS, 'name' => ZENKOKU),
		));

	}

    function get_parent_child($parent_id, $child_id, $order = 'ask') {
        $target = $this->_get_cache('master_tag_parent_child_'. $parent_id. '_'. $child_id);
        if (!$target) {
            $this->recursive = -1;
            $tags = $this->find('all', array(
                'conditions' => array('or' => array(array('master_id' => $parent_id), array('master_id' => $child_id))),
                'order' => 'left '. $order));
            $target = array();
            $i = 0;
            foreach ($tags as $t) {
                if ($t['MasterTag']['master_id'] == $parent_id) {
                    $i++;
                    $target[$i] = $t;
                } else {
                    $target[$i]['children'][] = $t;
                }
            }
            Cache::write('master_tag_parent_child_'. $parent_id. '_'. $child_id, $target);
        }
        return $target;
    }

	function findPrefectire($romaji) {
		return $this->find('first', array(
			'conditions' => array('master_id' => BOSS, 'other_name' => $romaji),
		));
	}

}
