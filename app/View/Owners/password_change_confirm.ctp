<div id="loginInnerWrap">
<!--	<div class="section"><img src="images/common/bd_section.png" /></div>-->
	<div id="loginInner">
		<?php echo $this->Form->create('Owner', array('url' => $this->Html->Url('/owners/passwordChangeComplete'), 'id' => 'loginform', 'class' => 'bs-example form-horizontal') ); ?>
		<div id="loginInnerContent">
<!--			<div id="topIcon"><img src="images/login/Icon_topIcon.png" width="100%" /></div>-->
			<div id="sectionTop">
				<p id="sectionTitle">パスワード再設定</p>
				<p id="sectionCaption">URLの認証を確認しました。</p>
			</div>

			<div class="inputWrap">
				<p class="label">パスワード<span class="attention">6〜16文字の英数字でパスワードを再設定してください</span></p>
				<?php echo $this->Form->input('password', array('type' => 'password', 'label' => false, 'id' => 'user_login', 'class' => 'input', 'div' => false)); ?>
				<!-- エラー時に表示するテキストです -->
				<div class="error">
					<p>エラーメッセージ</p>
				</div>
			</div>
			<div class="inputWrap">
				<p class="label">パスワード再入力</p>
				<?php echo $this->Form->input('password_confirm', array('type' => 'password', 'label' => false, 'id' => 'user_login', 'class' => 'input', 'div' => false)); ?>
				<!-- エラー時に表示するテキストです -->
				<div class="error">
					<p>エラーメッセージ</p>
				</div>
			</div>

			<?php echo $this->Form->submit(__('設定'), array('class' => 'halfButtonB ophv')); ?>
		</div><!-- /#loginInnerContent -->
	</div><!-- /#loginInner -->
	<?php echo $this->Form->end(__('')); ?>
	<div class="section"><img src="images/common/bd_section.png" /></div>
	<div class="privacy">
		<a href="#">利用規約及び個人情報に関して</a>
	</div>
</div><!-- /#loginInnerWrap -->
