<?php
App::uses('AppModel', 'Model');
/**
 * OwnerRegistration Model
 *
 */
class OwnerRegistration extends AppModel {

    public $validate = [
        // メールアドレス
        'email' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '必須項目です'),
            'maxLength' => array('rule' => array('maxlength', 200), 'message' => '最大文字数は200文字です'),
            'email' => array('rule' => array('email'), 'message' => 'メールアドレス形式で入力してください'),
            'incorrect' => array('rule' => array('checkUsedEmail'), 'message' => '既に同じメールアドレスのオーナーが登録されています'),
        ],
    ];

    /**
     * 同じメールアドレスのオーナーがいるかチェック
     *
     * @param $check
     * @return bool
     */
    public function checkUsedEmail($check) {
        if (empty($check)) {
            return true;
        }

        $email = array_shift($check);
        /** @var Owner $Owner */
        $Owner = ClassRegistry::init('Owner');
        $conditions = [
            'Owner.email' => $email,
        ];
        $contain = [];
        $cnt = $Owner->find('count', compact('conditions', 'contain'));
        return empty($cnt);
    }

    /**
     * @param array $options
     * @return bool
     */
    public function beforeSave($options = array()) {

        $registrationDate = strftime('%F %T');
        $this->data[$this->alias]['registration_date'] = $registrationDate;

        $token = Security::hash($this->data[$this->alias]['email'] . $registrationDate, 'sha256', true);
        $this->data[$this->alias]['token'] = $token;

        return true;
    }


}
