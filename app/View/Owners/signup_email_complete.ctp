<?php
/**
 * Created by IntelliJ IDEA.
 * User: booyan
 * Date: 14/12/13
 * Time: 20:55
 *
 * @var $this AppView
 * @var $ownerRegistration array
 */
$this->Html->css('complete', ['inline' => false]);
?>
<div id="compInnerWrap">
    <div class="section"><img src="/images/common/bd_section.png" /></div>
    <div id="compInner">
        <div id="compInnerContent">
            <div id="topIcon"><img src="/images/login/Icon_topIcon.png" width="100%" /></div>
            <div id="sectionTop">
                <p id="sectionTitle">新規会員登録</p>
                <p id="sectionCaption">以下のメールアドレスに確認メールを送信しました。</p>
                <?= $this->Html->link('test', ['controller' => 'owners', 'action' => 'signupEmailConfirm', $ownerRegistration['OwnerRegistration']['id'], $ownerRegistration['OwnerRegistration']['token']], true); ?>
            </div>
            <div class="confirm">
                <p class=""><?= h($ownerRegistration['OwnerRegistration']['email']); ?></p>
            </div>
            <p class="note">お届けしたメール内のURLをクリックしてユーザー登録を続けてください。メールに記載されたURLの有効期限は24時間です。有効期限が切れた場合は、再度メールアドレスの入力を行ってください。確認メールが届かない場合は迷惑メールフォルダに振り分けられている場合がありますので、改めてご確認ください。また、petandyou.jpのドメイン指定受信を許諾に設定してください。</p>
            <!-- ボーダーボタン -->
            <a href="#" class="borderButton">PandY TOPページへ</a>
        </div><!-- /#compInnerContent -->
    </div><!-- /#compInner -->
    <div class="section"><img src="/images/common/bd_section.png" /></div>
    <div class="privacy">
        <a href="#">利用規約及び個人情報に関して</a>
    </div>
</div><!-- /#compInnerWrap -->
