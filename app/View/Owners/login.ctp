<?php echo $this->Form->create('Owner', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>
<fieldset>
	<legend>Beer</legend>
	<?php echo $this->Form->input('text', array(
		'label' => 'Label name',
		'placeholder' => 'Type something…',
		'after' => '<span class="help-block">Example block-level help text here.</span>'
	)); ?>

	<?php echo $this->Form->submit('Submit', array(
		'div' => false,
		'class' => 'btn btn-default'
	)); ?>
</fieldset>
<?php echo $this->Form->end(); ?>



<div id="loginInnerWrap">
	<div class="section"></div>
	<div id="loginInner">
		<?php echo $this->Form->create('Owner', array('url' => $this->Html->Url('/owners/login'), 'id' => 'loginform', 'class' => 'bs-example form-horizontal') ); ?>
		<div id="loginInnerContent">
			<div id="topIcon"></div>
			<div id="sectionTop">
				<p id="sectionTitle">beer ログイン</p>
				<p id="sectionCaption">beerを楽しむには会員登録をしてログインが必要です。</p>
			</div>
			<!-- エラー時に表示するテキストです -->
			<div class="inputWrap">
				<div class="error">
					<p>エラーメッセージ</p>
				</div>
			</div>

			<div class="inputWrap">
				<p class="label">メールアドレス</p>
				<?php echo $this->Form->input('email', array('label' => false, 'id' => 'user_login', 'div' => false)); ?>
			</div>
			<div class="inputWrap">
				<p class="label">パスワード</p>
				<?php echo $this->Form->input('password', array('label' => false, 'id' => 'user_pass', 'size' => 20, 'div' => false)); ?>
			</div>

			<?php echo $this->Html->link("パスワードをお忘れの方はこちら", array('controller' => 'owners', 'action' => 'password'), array('class' => 'underLine')); ?>

			<?php echo $this->Html->link("新規登録の方はこちら", array('controller' => 'owners', 'action' => 'signupEmail'), array('class' => 'borderButton ophv')); ?>
			<div class="buttonWrap">
				<a href="#" class="halfButtonA ophv">戻る</a><!-- ※ログイン画面って戻れますっけ？ -->
				<?php echo $this->Form->submit(__('ログイン'), array('class' => 'btn btn-default')); ?>
			</div>

		</div><!-- /#loginInnerContent -->
		<?php echo $this->Form->end(__('')); ?>
	</div><!-- /#loginInner -->
	<div class="section"><img src="images/common/bd_section.png" /></div>
	<div class="privacy">
		<a href="#">利用規約及び個人情報に関して</a>
	</div>
</div><!-- /#loginInnerWrap -->
