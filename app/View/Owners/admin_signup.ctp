<?php
/**
 * Created by IntelliJ IDEA.
 * User: booyan
 * Date: 14/12/14
 * Time: 5:54
 *
 * @var $this AppView
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

            </div>


            <button class="halfButtonB ophv">ペット情報へ</button>
        </div><!-- / .inWrap  -->
        <?= $this->Form->end(); ?>
    </div><!-- / #inputArea  -->
    <div id="bottomArea">
        <p class="sectionLine"><img src="/images/common/bd_section.png"></p>
        <a class="ophv" href="#">利用規約及び個人情報に関して</a>
    </div>
</div><!-- / .formInner  -->
