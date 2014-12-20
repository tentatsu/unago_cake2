<?php
/**
 * Created by IntelliJ IDEA.
 * User: booyan
 * Date: 14/12/14
 * Time: 5:54
 *
 * @var $this AppView
 * @var $companies array
 */

$this->Html->css('form', ['inline' => false]);

$this->Html->script('form', ['inline' => false]);
$this->Html->script('customSelect', ['inline' => false]);
$this->Html->scriptStart(['inline' => false]);
?>
$(function () {
    $('.fmselect').customSelect();
});
<?php
$this->Html->scriptEnd();
?>
<div class="formInner">
    <p class="sectionLine top"><span><img src="/images/common/bd_section.png"></span></p>
    <div id="headArea">
        <p id="headLogo"><img src="/images/form/img_petwork.png"></p>
        <div id="pageHead" class="inWrap">
            <img src="/images/form/icon_dogcat.png">
            <p id="headTitle">PandY 新規会員登録</p>
            <p id="headCaption">以下のフォームに必要事項を入力してください。</p>
            <?php echo $this->Session->flash(); ?>
        </div><!-- / .inWrap  -->
    </div><!-- / #headArea  -->

    <div id="selectFlow"><img src="/images/form/img_selectFlow0.png" alt="1 オーナー情報"></div>
    <!-- ↑↑ オーナー情報であればselectFlow0.png、ペット情報であればselectFlow1.png、アンケートであればselectFlow2.pngとしてください。 -->
    <!-- ↑↑ PandY 新規会員登録ページ以外では必要ない項目なので class="dn"を付けて隠してください -->

    <p class="sectionLine bottom"><span><img src="/images/common/bd_section.png"></span></p>
    <div id="inputArea">
        <?= $this->Form->create('Owner', [
            'inputDefaults' => [
                'div' => false,
                'label' => false,
                'error' => false,
            ],
        ]); ?>
        <?= $this->Form->hidden('p', ['value' => Configure::read('Owner.signup_process.pet')]); ?>
        <div class="inWrap">
            <div class="sectionBox">
                <p id="subjectPt">※必須項目</p>

                <div class="inputBox double">
                    <div class="inputTitle"><p>名前(漢字)<span class="important red">※</span></p></div>
                    <?= $this->Form->input('last_name', ['class' => 'boxLeft']); ?>
                    <?= $this->Form->input('first_name', ['class' => 'boxRight']); ?>
                    <?php if ($this->Form->isFieldError('last_name')): ?>
                    <div class="errorBox"><?= $this->Form->error('last_name', null, ['wrap' => 'p', 'class' => false]); ?></div>
                    <?php endif; ?>
                    <?php if ($this->Form->isFieldError('first_name')): ?>
                        <div class="errorBox"><?= $this->Form->error('first_name', null, ['wrap' => 'p', 'class' => false]); ?></div>
                    <?php endif; ?>
                </div><!-- / .inputBox.double  -->

                <div class="inputBox double">
                    <div class="inputTitle"><p>名前(カナ)<span class="important red">※</span></p></div>
                    <?= $this->Form->input('last_name_kana', ['class' => 'boxLeft']); ?>
                    <?= $this->Form->input('first_name_kana', ['class' => 'boxRight']); ?>
                    <?php if ($this->Form->isFieldError('last_name_kana')): ?>
                        <div class="errorBox"><?= $this->Form->error('last_name_kana', null, ['wrap' => 'p', 'class' => false]); ?></div>
                    <?php endif; ?>
                    <?php if ($this->Form->isFieldError('first_name_kana')): ?>
                        <div class="errorBox"><?= $this->Form->error('first_name_kana', null, ['wrap' => 'p', 'class' => false]); ?></div>
                    <?php endif; ?>
                </div><!-- / .inputBox.double  -->

                <div class="inputBox radio">
                    <div class="inputTitle"><p>所属会社<span class="important red">※</span></p></div>
                    <?= $this->Form->fInput('company_id', [
                        'type' => 'radio',
                        'options' => $companies,
                        'legend' => false,
                        'fieldset' => false,
                    ]); ?>
                </div><!-- / .inputBox.radio  -->

                <div class="inputBox single">
                    <div class="inputTitle"><p>部署名<span class="important red">※</span></p><p class="attention red">所属会社のメールアドレスを登録してください</p></div>
                    <?= $this->Form->fInput('section'); ?>
                </div><!-- / .inputBox.single  -->

                <div class="inputBox single">
                    <div class="inputTitle"><p>パスワード<span class="important red">※</span></p><p class="attention">6〜16文字の半角英数字</p></div>
                    <?= $this->Form->fInput('password', [
                        'type' => 'password',
                    ]); ?>
                </div><!-- / .inputBox.single  -->

                <div class="inputBox single">
                    <div class="inputTitle"><p>パスワード再入力<span class="important red">※</span></p><p class="attention">6〜16文字の半角英数字</p></div>
                    <?= $this->Form->fInput('password_confirm', [
                        'type' => 'password',
                    ]); ?>
                </div><!-- / .inputBox.single  -->

                <div class="inputBox selectOnce">
                    <div class="inputTitle"><p>お住まい<span class="important red">※</span></p></div>
                    <?= $this->Form->fInput('prefecture', [
                        'type' => 'select',
                        'options' => Configure::read('Prefectures'),
                        'empty' => '都道府県',
                        'class' => 'fmselect',
                    ]) ?>
                </div><!-- / .inputBox.select  -->

                <div class="inputBox radio">
                    <div class="inputTitle"><p>オーナー情報をマイページで公開しますか<span class="important red">※</span></p></div>
                    <?= $this->Form->fInput('is_open', [
                        'type' => 'radio',
                        'options' => Configure::read('Owner.is_open'),
                        'legend' => false,
                        'fieldset' => false,
                    ]); ?>
                </div><!-- / .inputBox.radio  -->
            </div>

            <div class="sectionBox">
                <p class="sectionTitle">犬猫健康診断キット送付先</p>
                <p class="sectionSubTitle red">診断キット申込の際に必要となります。申込時入力も可能です。</p>

                <div class="inputBox double">
                    <div class="inputTitle"><p>郵便番号</p></div>
                    <?= $this->Form->input('Address.zip1', ['class' => 'boxLeft']); ?>
                    <?= $this->Form->input('Address.zip2', ['class' => 'boxRight']); ?>
                    <?php if ($this->Form->isFieldError('zip1')): ?>
                        <div class="errorBox"><?= $this->Form->error('zip1', null, ['wrap' => 'p', 'class' => false]); ?></div>
                    <?php endif; ?>
                    <?php if ($this->Form->isFieldError('zip2')): ?>
                        <div class="errorBox"><?= $this->Form->error('zip2', null, ['wrap' => 'p', 'class' => false]); ?></div>
                    <?php endif; ?>
                </div><!-- / .inputBox.double  -->

                <div class="inputBox single">
                    <div class="inputTitle"><p>住所</p></div>
                    <?= $this->Form->fInput('Address.address1'); ?>
                </div><!-- / .inputBox.single  -->

                <div class="inputBox single">
                    <div class="inputTitle"><p>建物名・号室</p></div>
                    <?= $this->Form->fInput('Address.address2'); ?>
                </div><!-- / .inputBox.single  -->

                <div class="inputBox single">
                    <div class="inputTitle"><p>電話番号</p></div>
                    <input type="text" name="" id="">
                </div><!-- / .inputBox.single  -->
            </div>

            <button class="halfButtonB ophv">ペット情報へ</button>
            <p class="textBox text tac">オーナー情報は登録後に変更可能です</p>
        </div><!-- / .inWrap  -->
        <?= $this->Form->end(); ?>
    </div><!-- / #inputArea  -->
    <div id="bottomArea">
        <p class="sectionLine"><img src="/images/common/bd_section.png"></p>
        <a class="ophv" href="#">利用規約及び個人情報に関して</a>
    </div>
</div><!-- / .formInner  -->
