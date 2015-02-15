<?php
App::uses('AppModel', 'Model');
/**
 * Owner Model
 *
 * @property Address $Address
 * @property Company $Company
 * @property Pet $Pet
 * @property Questionnaire $Questionnaire
 */
class Owner extends AppModel {

    public $virtualFields = array(
        'name' => 'CONCAT(Owner.last_name, " ", Owner.first_name)',
    );

    public $validate = [
        'last_name' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '姓は必須項目です'),
            'maxLength' => array('rule' => array('maxlength', 30), 'message' => '姓の最大文字数は30文字です'),
        ],
        'first_name' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '名は必須項目です'),
            'maxLength' => array('rule' => array('maxlength', 30), 'message' => '名の最大文字数は30文字です'),
        ],
        'password' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '必須項目です'),
            'alphabet' => array('rule' => 'alphaNumeric', 'message' => '半角英数字で入力してください'),
            'between' => array('rule' => array('betweenJP', 6, 16), 'message' => '6〜16文字で入力してください'),
            'compare' => array('rule' => array('compare2fields', 'password_confirm'), 'message' => 'パスワード確認と一致しませんでした'),
        ],
        'email' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '必須項目です'),
            'maxLength' => array('rule' => array('maxlength', 200), 'message' => '最大文字数は200文字です'),
            'email' => array('rule' => array('email'), 'message' => 'メールアドレス形式で入力してください'),
            'unique' => array('rule' => array('isUnique'), 'message' => '既に同じメールアドレスで登録されています'),
        ],
    ];

    /**
     * @param array $options
     * @return bool
     */
    public function beforeSave($options = array())
    {
        // パスワードをハッシュ化
        if (!empty($this->data[$this->alias]['password'])) {
            App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
            $passwordHasher = new SimplePasswordHasher(['hashType' => 'sha256']);
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        }

        return true;
    }

}
