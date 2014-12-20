<?php
App::uses('AppModel', 'Model');
/**
 * Address Model
 *
 * @property Owner $Owner
 */
class Address extends AppModel {

    public $belongsTo = [
        'Owner',
    ];

    public $validate = [
        'zip1' => [
            'zip1' => array('rule' => array('zip1'), 'allowEmpty' => true, 'message' => ' 半角数字3文字を入力してください'),
        ],
        'zip2' => [
            'zip2' => array('rule' => array('zip2'), 'allowEmpty' => true, 'message' => ' 半角数字4文字を入力してください'),
        ],
        'address1' => [
            'maxLength' => array('rule' => array('maxlength', 200), 'allowEmpty' => true, 'message' => '最大文字数は200文字です'),
        ],
        'address2' => [
            'maxLength' => array('rule' => array('maxlength', 200), 'allowEmpty' => true, 'message' => '最大文字数は200文字です'),
        ],
        'tel' => [
            'tel' => array('rule' => 'telFaxJp', 'allowEmpty' => true, 'message' => '電話番号が正しくありません'),
        ],
    ];
}
