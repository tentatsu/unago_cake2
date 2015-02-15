<div id="loginInnerWrap">
<!--	<div class="section"><img src="images/common/bd_section.png" /></div>-->
	<div id="loginInner">
		<?php echo $this->Form->create('Owner', array('url' => $this->Html->Url('/owners/password'), 'id' => 'loginform', 'class' => 'bs-example form-horizontal') ); ?>
		<div id="loginInnerContent">
<!--			<div id="topIcon"><img src="images/login/Icon_topIcon.png" width="100%" /></div>-->
			<div id="sectionTop">
				<p id="sectionTitle">パスワード再設定</p>
				<p id="sectionCaption">パスワード変更用のURLをお送りしますので、<br>メールアドレスを入力してください。</p>
			</div>

			<div class="inputWrap">
				<p class="label">メールアドレス</p>
				<?php echo $this->Form->input('email', array('label' => false, 'id' => 'user_login', 'class' => 'input', 'div' => false)); ?>
				<!-- エラー時に表示するテキストです -->
				<div class="error">
					<p>エラーメッセージ</p>
				</div>
			</div>

			<div class="buttonWrap">
				<?php echo $this->Html->link("戻る", array('controller' => 'owners', 'action' => 'login'), array('class' => 'halfButtonA ophv')); ?>
				<?php echo $this->Form->submit(__('送信'), array('class' => 'button button-primary button-large')); ?>
			</div>

			<a href="#" class="borderButton ophv">新規登録の方はこちら</a>

		</div><!-- /#loginInnerContent -->
	</div><!-- /#loginInner -->
	<?php echo $this->Form->end(__('')); ?>
	<div class="section"><img src="images/common/bd_section.png" /></div>
	<div class="privacy">
		<a href="#">利用規約及び個人情報に関して</a>
	</div>
</div><!-- /#loginInnerWrap -->
