<?php
/**
 * Created by IntelliJ IDEA.
 * User: booyan
 * Date: 14/12/13
 * Time: 20:08
 */

class OwnerRegistrationService {

    /** @var  CakeEmail */
    private $__CakeEmail;
    /** @var  OwnerRegistration */
    private $__OwnerRegistration;
    /** @var  Owner */
    private $__Owner;

    /**
     * コンストラクタ
     *
     * @param CakeEmail $CakeEmail
     * @param OwnerRegistration $OwnerRegistration
     * @param Owner $Owner
     */
    function __construct(CakeEmail $CakeEmail = null, OwnerRegistration $OwnerRegistration = null, Owner $Owner = null) {
        $this->__CakeEmail = ($CakeEmail) ? $CakeEmail : new CakeEmail();
        $this->__OwnerRegistration = ($OwnerRegistration) ? $OwnerRegistration : ClassRegistry::init('OwnerRegistration');
        $this->__Owner = ($Owner) ? $Owner : ClassRegistry::init('Owner');
    }

    /**
     * 確認メールを送信する
     *
     * @param array $ownerRegistration
     */
    public function sendConfirmEmail(array $ownerRegistration) {
        $email = $ownerRegistration['OwnerRegistration']['email'];
        $this->__CakeEmail->addTo($email)
            ->subject('【Beers】本登録手続きのお願い')
            ->template('registration_confirm', 'default')
            ->viewVars([
                'ownerRegistration' => $ownerRegistration,
            ]);
        $this->__CakeEmail->send();
    }

	/**
	 * パスワード変更確認メールを送信する
	 *
	 * @param array $ownerRegistration
	 */
	public function sendChangeEmail(array $owner) {
		$email = $owner['Owner']['email'];
		$this->__CakeEmail->addTo($email)
			->subject('【PandY ペットアンドユウ】パスワード再設定')
			->template('password_change_confirm', 'default')
			->viewVars([
				'owner' => $owner,
			]);
		$this->__CakeEmail->send();
	}

    /**
     * メールからのリンクが有効かチェック
     *
     * @param $id
     * @param $token
     * @return bool
     */
    public function confirmEmail($id, $token) {
        $conditions = [
            'OwnerRegistration.id' => $id,
            'OwnerRegistration.token' => $token,
        ];
        $contain = [];
        $ownerRegistration = $this->__OwnerRegistration->find('first', compact('conditions', 'contain'));
        if (empty($ownerRegistration['OwnerRegistration'])) {
            CakeLog::alert("新規登録情報が見つかりませんでした。id = " . $id);
            return false;
        }

        $registrationDate = strtotime($ownerRegistration['OwnerRegistration']['registration_date']);
        $now = time();
        if (($now - $registrationDate) > (60 * 60 * 24)) {
            return false;
        }

        return $ownerRegistration;
    }

    /**
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function saveOwner(array $data) {
        print_r($data);
        if (!$this->__Owner->save($data)) {
            print_r($this->__Owner->validationErrors);
            return false;
        }
        $ownerId = $this->__Owner->id;
        $conditions = [
            'Owner.id' => $ownerId,
        ];
        $owner = $this->__Owner->find('first', compact('conditions', 'contain'));

        $email = $data['Owner']['email'];
        $this->__CakeEmail->addTo($email)
            ->subject('【Beer】会員登録完了のご案内')
            ->template('signup_complete', 'default')
            ->viewVars([
                'owner' => $owner,
            ]);
        $this->__CakeEmail->send();

        return true;
    }
}