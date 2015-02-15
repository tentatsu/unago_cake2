<?php
/**
 * Created by IntelliJ IDEA.
 * User: booyan
 * Date: 14/12/13
 * Time: 17:59
 *
 * @var $this AppView
 */

$this->Html->css('login', ['inline' => false]);
?>
<div id="loginInnerWrap">
    <div id="loginInner">
        <div id="loginInnerContent">
            <div id="topIcon"></div>
            <div id="sectionTop">
                <p id="sectionTitle">新規会員登録</p>
                <p id="sectionCaption">登録用のURLをお送りしますので、メールアドレスを入力してください。</p>
                <?php echo $this->Session->flash(); ?>
            </div>

            <?= $this->Form->create('OwnerRegistration', [
                'inputDefaults' => [
                    'div' => false,
                    'label' => false,
                    'error' => false,
                ],
            ]); ?>
            <div class="inputWrap">
                <p class="label">メールアドレス</p>
                <?= $this->Form->pInput('email', [
                    'type' => 'email',
                ]); ?>
            </div>

            <div class="buttonWrap">
                <a href="#" class="halfButtonA ophv">戻る</a>
                <button class="halfButtonB ophv">送信</button>
            </div>
            <?= $this->Form->end(); ?>

            <a href="#" class="borderButton ophv">新規登録の方はこちら</a>

        </div><!-- /#loginInnerContent -->
    </div><!-- /#loginInner -->
    <div class="section"><img src="/images/common/bd_section.png" /></div>
    <div class="privacy">
        <a href="#">利用規約及び個人情報に関して</a>
    </div>
</div><!-- /#loginInnerWrap -->
