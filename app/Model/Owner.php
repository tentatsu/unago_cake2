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
        'kana' => 'CONCAT(Owner.last_name_kana, " ", Owner.first_name_kana)',
    );

    public $belongsTo = [
        'Company',
    ];

    public $hasOne = [
        'Address',
    ];

    public $hasMany = [
        'Pet',
        'Questionnaire',
    ];

    public $validate = [
        'last_name' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '姓は必須項目です'),
            'maxLength' => array('rule' => array('maxlength', 30), 'message' => '姓の最大文字数は30文字です'),
        ],
        'first_name' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '名は必須項目です'),
            'maxLength' => array('rule' => array('maxlength', 30), 'message' => '名の最大文字数は30文字です'),
        ],
        'last_name_kana' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '姓(カナ)は必須項目です'),
            'maxLength' => array('rule' => array('maxlength', 30), 'message' => '姓(カナ)の最大文字数は30文字です'),
        ],
        'first_name_kana' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '名(カナ)は必須項目です'),
            'maxLength' => array('rule' => array('maxlength', 30), 'message' => '名(カナ)の最大文字数は30文字です'),
        ],
        'company_id' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '必須項目です'),
            'incorrect' => array('rule' => array('hasModelId', 'Company'), 'message' => '正しくありません'),
        ],
        'section' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '必須項目です'),
            'maxLength' => array('rule' => array('maxlength', 200), 'message' => '最大文字数は200文字です'),
        ],
        'password' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '必須項目です'),
            'alphabet' => array('rule' => 'alphaNumeric', 'message' => '半角英数字で入力してください'),
            'between' => array('rule' => array('betweenJP', 6, 16), 'message' => '6〜16文字で入力してください'),
            'compare' => array('rule' => array('compare2fields', 'password_confirm'), 'message' => 'パスワード確認と一致しませんでした'),
        ],
        'prefecture' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '必須項目です'),
            'incorrect' => array('rule' => array('hasPrefecture'), 'message' => '正しくありません'),
        ],
        'is_open' => [
            'require' => array('rule' => 'notEmpty', 'required' => true, 'message' => '必須項目です'),
            'boolean' => array('rule' => 'boolean', 'message' => '正しくありません'),
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
