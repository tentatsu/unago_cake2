<?php
class Attachment extends AppModel {

	public $actsAs = array(
		'Upload.Upload' => array(
			'images' => array(
				'thumbnailSizes' => array(
					'thumb150' => '150x150',
					'thumb80' => '80x80',
				),
				'thumbnailMethod' => 'php',
				'fields' => array('dir' => 'dir', 'type' => 'type', 'size' => 'size'),
				'mimetypes' => array('image/jpeg', 'image/gif', 'image/png'),
				'extensions' => array('jpg', 'jpeg', 'JPG', 'JPEG', 'gif', 'GIF', 'png', 'PNG'),
				'rootDir' => ROOT,
				'path' => '{ROOT}{DS}app{DS}webroot{DS}files{DS}{parent_model}{DS}{field}{DS}',
				'maxSize' => 2097152, //2MB
			),
//			'others' => array(
//				'thumbnailSizes' => array(
//					'thumb' => '100x100'
//				),
//				'thumbnailMethod' => 'php',
//				'fields' => array('dir' => 'dir', 'type' => 'type', 'size' => 'size')
//			),
		),
	);


	public $belongsTo = array(
		'Beer' => array(
			'className' => 'Beer',
			'foreignKey' => 'foreign_key',
		),
		'MasterTag' => array(
			'className' => 'MasterTag',
			'foreignKey' => 'foreign_key',
		),

	);
	public function beforeSave($options = array()) {
		$newPath = Folder::slashTerm(str_replace(
			array('{parent_model}'),
			array(Inflector::underscore($this->data['Image']['model'])),
			$this->Behaviors->Upload->settings['Image']['images']['path']
		));
		$this->Behaviors->Upload->settings['Image']['images']['path'] = $newPath;
		$this->Behaviors->Upload->settings['Image']['images']['thumbnailPath'] = $newPath;

//		vd($this->Behaviors);
	}
}
?>