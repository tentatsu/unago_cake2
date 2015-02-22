<?php
/**
 * Created by IntelliJ IDEA.
 * User: booyan
 * Date: 14/12/14
 * Time: 11:30
 *
 * @var $this AppView
 * @var $petClassifications array
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
        </div><!-- / .inWrap  -->
    </div><!-- / #headArea  -->

    <div id="selectFlow"><img src="/images/form/img_selectFlow1.png" alt="2 ペット情報"></div>
    <!-- ↑↑ オーナー情報であればselectFlow0.png、ペット情報であればselectFlow1.png、アンケートであればselectFlow2.pngとしてください。 -->
    <!-- ↑↑ PandY 新規会員登録ページ以外では必要ない項目なので class="dn"を付けて隠してください -->

    <p class="sectionLine bottom"><span><img src="/images/common/bd_section.png"></span></p>
    <div id="inputArea">
        <?= $this->Form->create('Pet', [
            'inputDefaults' => [
                'div' => false,
                'label' => false,
                'error' => false,
            ],
        ]); ?>
        <div class="inWrap">
            <div class="sectionBox">
                <p id="subjectPt">※必須項目</p>

                <div class="inputBox radio">
                    <div class="inputTitle"><p>種別<span class="important red">※</span></p></div>
                    <?= $this->Form->fInput('0.pet_classification_id', [
                        'type' => 'radio',
                        'options' => $petClassifications,
                        'legend' => false,
                        'fieldset' => false,
                    ]); ?>
                    <div class="inputTitle"><p class="attention">その他を選択した場合は記入</p></div>
                    <div class="checkText">
                        <?= $this->Form->fInput('0.classification_other', ['class' => 'boxLeft', 'required' => false]); ?>
                    </div>
                </div><!-- / .inputBox.radio  -->

                <div class="inputBox single">
                    <div class="inputTitle"><p>名前<span class="important red">※</span></p></div>
                    <?= $this->Form->fInput('0.name'); ?>
                </div><!-- / .inputBox.single  -->

                <div class="inputBox radio">
                    <div class="inputTitle"><p>性別<span class="important red">※</span></p></div>
                    <?= $this->Form->fInput('0.sex', [
                        'type' => 'radio',
                        'options' => Configure::read('Pet.sex'),
                        'legend' => false,
                        'fieldset' => false,
                    ]); ?>
                </div><!-- / .inputBox.radio  -->

                <div class="inputBox single">
                    <div class="inputTitle"><p>犬種・猫種<span class="important red">※</span></p><p class="attention red">例：柴犬</p></div>
                    <?= $this->Form->fInput('0.classification'); ?>
                </div><!-- / .inputBox.single  -->

                <div class="inputBox selectOnce">
                    <div class="inputTitle"><p>年齢<span class="important red">※</span></p></div>
                    <?= $this->Form->fInput('0.age', [
                        'type' => 'select',
                        'options' => Configure::read('Pet.age'),
                        'empty' => '--',
                        'class' => 'fmselect',
                    ]); ?>
                </div><!-- / .inputBox.select  -->

                <div class="inputBox upLoadMulti"><!-- 複数画像アップロード -->
                    <div class="inputTitle"><p>写真<span class="important red">※</span></p><p class="attention red">1写真必須、またアップした写真はTOPページに掲載されます</p></div>
                    <ul>
                        <li>
                            <div><img src="/images/form/img_upload.jpg"><!-- ここにアップロードされる画像を設置してください。 --></div>
                            <p class="ophv">アップロード</p>
                        </li>
                        <li>
                            <div><img src="/images/form/img_upload.jpg"><!-- ここにアップロードされる画像を設置してください。 --></div>
                            <p class="ophv">アップロード</p>
                        </li>
                        <li>
                            <div><img src="/images/form/img_upload.jpg"><!-- ここにアップロードされる画像を設置してください。 --></div>
                            <p class="ophv">アップロード</p>
                        </li>
                        <li class="noM">
                            <div><img src="/images/form/img_upload.jpg"><!-- ここにアップロードされる画像を設置してください。 --></div>
                            <p class="ophv">アップロード</p>
                        </li>
                    </ul>
                    <div class="bottomText red">※写真の形式は、jpg、gif、png、容量は2MBまで</div>
                </div><!-- / .inputBox.upLoad  -->

                <div class="inputBox textArea">
                    <div class="inputTitle"><p>特徴・特技・メッセージなど</p></div>
                    <?= $this->Form->fInput('0.message', ['type' => 'textarea']); ?>
                </div><!-- / .inputBox.textArea  -->

                <div class="sectionLine"></div>

                <p class="addBtn ophv">ペットを追加する</p>
            </div>

            <div class="buttonWrap">
                <a href="#" class="halfButtonA ophv">戻る</a>
                <button class="halfButtonB ophv">アンケートへ</button>
            </div>
            <p class="textBox text tac">ペット情報は登録後に変更可能です</p>
        </div><!-- / .inWrap  -->
        <?= $this->Form->end(); ?>
    </div><!-- / #inputArea  -->
    <div id="bottomArea">
        <p class="sectionLine"><img src="/images/common/bd_section.png"></p>
        <a class="ophv" href="#">利用規約及び個人情報に関して</a>
    </div>
</div><!-- / .formInner  -->
